<template>
    <div class="calendar">
        <div class="row calendar__row">
            <!-- Loop 7 times -->
            <div class="col calendar__col" v-for="i in 7">

                <!-- If it's sunday, remove 7 days from current day. -->
                <div v-if="selectedDate.getDay() === 0" v-on:click="calenderClick(i)">
                    <div class="calendar__item" :data-id="i">
                        <h5 class="calendar__title">
                            {{getDayString(getOffsetDay((i-selectedDate.getDay()-7)).getDay())}}
                        </h5>

                        <div class="calendar__day">
                            <span>{{getOffsetDay((i-selectedDate.getDay()-7)).getDate()}}-{{getOffsetDay(i-selectedDate.getDay()-7).getMonth() + 1}}-{{getOffsetDay(i-selectedDate.getDay()-7).getFullYear()}}</span>
                        </div>
                    </div>
                </div>

                <!-- Else show normal week -->
                <div v-else v-on:click="calenderClick(i)">
                    <div class="calendar__item" :data-id="i">
                        <h5 class="calendar__title">
                            {{getDayString(getOffsetDay((i-selectedDate.getDay())).getDay())}}
                        </h5>

                        <div class="calendar__day">
                            <span>{{getOffsetDay((i-selectedDate.getDay())).getDate()}}-{{getOffsetDay(i-selectedDate.getDay()).getMonth() + 1}}-{{getOffsetDay(i-selectedDate.getDay()).getFullYear()}}</span>
                        </div>
                    </div>
                </div>

            </div>
            <button class="calendar__previous calendar__toggle-date" v-on:click="updateDay(-7)"><i
                class="fas fa-chevron-left"/></button>
            <button class="calendar__next calendar__toggle-date" v-on:click="updateDay(7)"><i
                class="fas fa-chevron-right"/></button>
        </div>

        <form @submit.prevent="submit" class="calendar__form">
            <div class="calendar__form--inner">
                <input type="hidden" name="_token" :value="csrf"/>

                <div class="row calendar__row--fields">

                    <input type="hidden" class="login__input" id="inputDate" v-model="fields.inputDate"
                           aria-describedby="inputDate"
                           placeholder="Datum">

                    <div class="col calendar__col">
                        <label for="inputBegin" class="login__label">Begintijd</label>
                        <input type="time" class="login__input" id="inputBegin" v-model="fields.inputBegin"
                               aria-describedby="inputBegin"
                               placeholder="begintijd">
                        <div v-if="errors && errors.inputBegin" class="text-danger">{{ errors.inputBegin[0] }}</div>
                    </div>

                    <div class="col calendar__col">
                        <label for="inputEnd" class="login__label">Eindtijd</label>
                        <input type="time" class="login__input" id="inputEnd" v-model="fields.inputEnd"
                               aria-describedby="inputEnd"
                               placeholder="eindtijd">
                        <div v-if="errors && errors.inputEnd" class="text-danger">{{ errors.inputEnd[0] }}</div>
                    </div>

                    <div class="col calendar__col">
                        <label for="inputBreak" class="login__label">Pauzeduratie</label>
                        <input type="time" class="login__input" id="inputBreak" v-model="fields.inputBreak"
                               aria-describedby="inputBreak"
                               placeholder="pauze">
                        <div v-if="errors && errors.inputBreak" class="text-danger">{{ errors.inputBreak[0] }}</div>
                    </div>
                </div>

                <button type="submit" class="button button--primary">Versturen</button>
            </div>
        </form>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Begintijd</th>
                <th scope="col">Eindtijd</th>
                <th scope="col">Pauze</th>
                <th scope="col">4</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="time in times">
                <td>{{time.begin}}</td>
                <td>{{time.end}}</td>
                <td>{{time.break}}</td>
                <td>{{time.date}}</td>
            </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
    export default {
        name: "WeekCalendarComponent",
        mounted() {
            // Get current user and call getTimes function after.
            this.getCurrentUser();
            // TODO: Highlight curent day.
        },
        data: function () {
            return {
                currentDate: new Date(),
                selectedDate: new Date(),
                offsetDate: new Date(),
                csrf: document.head.querySelector('meta[name="csrf-token"]').content,
                fields: {
                    user_id: '',
                    inputDate: ''
                },
                times: {},
                errors: {}
            }
        },
        methods: {
            submit() {
                this.errors = {};
                axios.post('/track-time', this.fields).then(response => {
                    console.log(response);
                    this.getTimes();

                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });
            },
            getCurrentUser() {
                const that = this;
                axios.get('/user/id', {})
                    .then(function (response) {
                        that.fields.user_id = response.data;
                        that.getTimes();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            getTimes() {
                const that = this;
                // TODO: Alleen times ophalen van geselecteerde datum.
                this.errors = {};
                axios.get('/times/' + this.fields.user_id).then(response => {
                    this.times = response.data;

                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });
            },
            calenderClick: function (index) {
                if (this.selectedDate.getDay() === 0) {
                    // TODO toISOString gebruikt een andere timezone, daardoor is dit 1 uur eerder dan utc +1. Dus als je tussen 0 en 1 in de nacht een tijd invoert dan zal die bij de dag daarvoor worden gezet.
                    this.fields.inputDate = this.getOffsetDay((index - this.selectedDate.getDay() - 7)).toISOString().split('T')[0];
                } else {
                    this.fields.inputDate = this.getOffsetDay(index - this.selectedDate.getDay()).toISOString().split('T')[0];
                }

                this.removeCalendarClasses();
                document.querySelector(".calendar__item[data-id='" + index + "']").classList.add('active');
            },
            removeCalendarClasses: function () {
                let calendar_items = document.getElementsByClassName("calendar__item");

                for (let i = 0; i < calendar_items.length; i++) {
                    calendar_items[i].classList.remove('active');
                }
            },
            // Turn 0 to 11 into string of month.
            getMonthString: function (month) {
                switch (month) {
                    case 0:
                        return "januari";
                    case 1:
                        return "februari";
                    case 2:
                        return "maart";
                    case 3:
                        return "april";
                    case 4:
                        return "mei";
                    case 5:
                        return "juni";
                    case 6:
                        return "juli";
                    case 7:
                        return "augustus";
                    case 8:
                        return "september";
                    case 9:
                        return "oktober";
                    case 10:
                        return "november";
                    case 11:
                        return "december";
                }
            },
            // Turn 0 to 6 into string of day.
            getDayString: function (day) {
                // getDay starts at sunday. (0 is sunday)
                switch (day) {
                    case 0:
                        return "zondag";
                    case 1:
                        return "maandag";
                    case 2:
                        return "dinsdag";
                    case 3:
                        return "woensdag";
                    case 4:
                        return "donderdag";
                    case 5:
                        return "vrijdag";
                    case 6:
                        return "zaterdag";
                }
            },
            // Add or remove amount of days provided in parameter.
            updateDay: function (days) {
                this.removeCalendarClasses();
                this.fields.inputDate = null;

                this.selectedDate = new Date(
                    this.selectedDate.setDate(this.selectedDate.getDate() + days)
                );
            },
            // Return the selectedDate offset by amount of days provided in parameter.
            getOffsetDay: function (days) {
                // Copy selected date without reference.
                let date = new Date(JSON.parse(JSON.stringify(this.selectedDate)));
                date.setDate(date.getDate() + days);
                return date;
            }
        }
    }
</script>
