<template>
    <div class="calendar">
        <div class="row calendar__row">
            <!-- Loop 7 times -->
            <div class="col calendar__col" v-for="i in 7">
                <div class="calendar__item">
                    <!-- If it's sunday, remove 7 days from current day. -->
                    <div v-if="selectedDate.getDay() === 0">
                        <h5 class="calendar__title">
                            {{getDayString(getOffsetDay((i-selectedDate.getDay()-7)).getDay())}}
                            {{getOffsetDay((i-selectedDate.getDay()-7)).getDate()}}
                            {{getMonthString(getOffsetDay(i-selectedDate.getDay()-7).getMonth())}}
                        </h5>

                        <!-- TODO: Maak dynamisch -->
                        <div class="calendar__small">10-10-2020</div>
                    </div>

                    <!-- If it's sunday, remove 7 days from current day. -->
                    <div v-else>
                        <h5 class="calendar__title">
                            {{getDayString(getOffsetDay(i-selectedDate.getDay()).getDay())}}
                            {{getOffsetDay(i-selectedDate.getDay()).getDate()}}
                            {{getMonthString(getOffsetDay(i-selectedDate.getDay()).getMonth())}}
                        </h5>
                    </div>
                </div>
            </div>
            <button class="calendar__previous calendar__toggle-date" v-on:click="updateDay(-7)"><i class="fas fa-chevron-left"/></button>
            <button class="calendar__next calendar__toggle-date" v-on:click="updateDay(7)"><i class="fas fa-chevron-right"/></button>
        </div>

        <form @submit.prevent="submit" class="calendar__form">
            <div class="calendar__form--inner">
                <input type="hidden" name="_token" :value="csrf"/>

                <!-- TODO: Replace with selectedDate -->
                <div class="form-group">
                    <label for="inputDate" class="login__label">Datum</label>
                    <input type="date" class="login__input" id="inputDate" v-model="fields.inputDate"
                           aria-describedby="inputDate"
                           placeholder="Datum">
                    <div v-if="errors && errors.inputDate" class="text-danger">{{ errors.inputDate[0] }}</div>
                </div>

                <div class="form-group">
                    <label for="inputBegin" class="login__label">Begintijd</label>
                    <input type="time" class="login__input" id="inputBegin" v-model="fields.inputBegin"
                           aria-describedby="inputBegin"
                           placeholder="begintijd">
                    <div v-if="errors && errors.inputBegin" class="text-danger">{{ errors.inputBegin[0] }}</div>
                </div>

                <div class="form-group">
                    <label for="inputEnd" class="login__label">Eindtijd</label>
                    <input type="time" class="login__input" id="inputEnd" v-model="fields.inputEnd"
                           aria-describedby="inputEnd"
                           placeholder="eindtijd">
                    <div v-if="errors && errors.inputEnd" class="text-danger">{{ errors.inputEnd[0] }}</div>
                </div>

                <div class="form-group">
                    <label for="inputBreak" class="login__label">Pauzeduratie</label>
                    <input type="time" class="login__input" id="inputBreak" v-model="fields.inputBreak"
                           aria-describedby="inputBreak"
                           placeholder="pauze">
                    <div v-if="errors && errors.inputBreak" class="text-danger">{{ errors.inputBreak[0] }}</div>
                </div>

                <button type="submit" class="button button--primary">Versturen</button>
            </div>
        </form>

    </div>
</template>

<script>
    export default {
        name: "WeekCalendarComponent",
        mounted() {
            const that = this;
            axios.get('/user/id', {})
                .then(function (response) {
                    that.fields.user_id = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        data: function () {
            return {
                currentDate: new Date(),
                selectedDate: new Date(2020, 0, 19),
                offsetDate: new Date(),
                csrf: document.head.querySelector('meta[name="csrf-token"]').content,
                fields: {
                    user_id: ''
                },
                errors: {}
            }
        },
        methods: {
            submit() {
                this.errors = {};
                axios.post('/track-time', this.fields).then(response => {
                    console.log(response);

                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });
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
