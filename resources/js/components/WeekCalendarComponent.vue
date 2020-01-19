<template>
    <div>

        <div class="row">
            <!-- Loop 7 times -->
            <div class="col" v-for="i in 7">

                <!-- If it's sunday, remove 7 days from current day. -->
                <div v-if="selectedDate.getDay() === 0">
                    {{getDayString(getOffsetDay((i-selectedDate.getDay()-7)).getDay())}}
                    {{getOffsetDay((i-selectedDate.getDay()-7)).getDate()}}
                    {{getMonthString(getOffsetDay(i-selectedDate.getDay()-7).getMonth())}}
                </div>

                <!-- If it's sunday, remove 7 days from current day. -->
                <div v-else>
                    {{getDayString(getOffsetDay(i-selectedDate.getDay()).getDay())}}
                    {{getOffsetDay(i-selectedDate.getDay()).getDate()}}
                    {{getMonthString(getOffsetDay(i-selectedDate.getDay()).getMonth())}}
                </div>

            </div>

        </div>

        <button v-on:click="updateDay(-7)">Previous week</button>
        <button v-on:click="updateDay(7)">Next week</button>

        <!--        <form method="POST" action="/reservering">-->
        <!--            <input type="hidden" name="_token" :value="csrf"/>-->

        <!--            <div class="form-group">-->
        <!--                <input type="text" class="form-control" id="inputBegin" aria-describedby="inputBegin"-->
        <!--                       placeholder="begintijd">-->
        <!--            </div>-->

        <!--            <div class="form-group">-->
        <!--                <input type="text" class="form-control" id="inputEind" aria-describedby="inputEind"-->
        <!--                       placeholder="eindtijd">-->
        <!--            </div>-->

        <!--            <div class="form-group">-->
        <!--                <input type="text" class="form-control" id="inputPauze" aria-describedby="inputPauze"-->
        <!--                       placeholder="pauze">-->
        <!--            </div>-->

        <!--            <button type="submit" class="btn btn-primary">Versturen</button>-->
        <!--        </form>-->

    </div>
</template>

<script>
    export default {
        name: "WeekCalendarComponent",
        data: function () {
            return {
                currentDate: new Date(),
                selectedDate: new Date(2020, 0, 19),
                offsetDate: new Date(),
                csrf: document.head.querySelector('meta[name="csrf-token"]').content
            }
        },
        methods: {
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
