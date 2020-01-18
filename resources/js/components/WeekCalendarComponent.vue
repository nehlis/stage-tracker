<template>
    <div>
        <h1>week calendar component</h1>

        <div class="row">

            <div class="col" v-for="i in 5">

                <h1>{{i-3}}</h1>
                <div>{{getOffsetDay(i-3)}}</div>

            </div>

<!--            <div class="col">-->
<!--                {{selectedDate.getDate() - 2}}-->
<!--                {{getMonth(selectedDate.getMonth())}}-->
<!--            </div>-->
<!--            <div class="col">-->
<!--                {{selectedDate.getDate() - 1}}-->
<!--                {{getMonth(selectedDate.getMonth())}}-->
<!--            </div>-->
<!--            <div class="col">-->
<!--                {{selectedDate.getDate()}}-->
<!--                {{getMonth(selectedDate.getMonth())}}-->
<!--            </div>-->
<!--            <div class="col">-->
<!--                {{selectedDate.getDate() + 1}}-->
<!--                {{getMonth(selectedDate.getMonth())}}-->
<!--            </div>-->
<!--            <div class="col">-->
<!--                {{selectedDate.getDate() + 2}}-->
<!--                {{getMonth(selectedDate.getMonth())}}-->
<!--            </div>-->
        </div>

<!--        {{selectedDate.getDate()}}-->
<!--        {{getMonth(selectedDate.getMonth())}}-->

        <button v-on:click="updateDay(-1)">Previous day</button>
        <button v-on:click="updateDay(1)">Next day</button>

    </div>
</template>

<script>
    export default {
        name: "WeekCalendarComponent",
        data: function () {
            return {
                currentDate: new Date(),
                selectedDate: new Date(),
                offsetDate: new Date(),
            }
        },
        methods: {
            getMonth: function (month) {
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
            updateDay: function (days) {
                this.selectedDate = new Date(
                    this.selectedDate.setDate(this.selectedDate.getDate() + days)
                );

                console.log(this.selectedDate.getDate());
            },
            getOffsetDay: function (days) {
                // Copy selected date without reference.
                let date = new Date(JSON.parse(JSON.stringify(this.selectedDate)));

                date.setDate(date.getDate() + days);
                return date;
            }
        }
    }
</script>
