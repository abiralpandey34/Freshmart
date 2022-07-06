const collectionTimeData = [
    {
        firstHour: 10,
        lastHour: 13,
    },
    {
        firstHour: 13,
        lastHour: 16,
    },
    {
        firstHour: 16,
        lastHour: 19,
    },
];

const collectionDayData = [
    {
        dayName: 'Wednesday',
        dayValue: 3,
    },
    {
        dayName: 'Thursday',
        dayValue: 4,
    },
    {
        dayName: 'Friday',
        dayValue: 5,
    },
];

const presentTime = new Date().getHours();
const presentWeekDay = new Date().getDay();
const collectionDaySelect = document.querySelector('#dayCollectionSelect');
const collectionTimeSelect = document.querySelector('#timeCollectionSelect');

window.onload = () => {
    // fill in the days
    for (let day of collectionDayData) {
        let optionElement;
        if (
            presentWeekDay >= day.dayValue ||
            (day.dayValue - presentWeekDay == 1 &&
                presentTime >= collectionTimeData[2].lastHour)
        ) {
            optionElement = addDayOption(day.dayName, 'Next');
        } else {
            optionElement = addDayOption(day.dayName, '');
        }

        collectionDaySelect.appendChild(optionElement);
    }

    addTimes();
};

function addTimes() {
    collectionTimeSelect.innerHTML = '';

    let selectedDay;
    for (let day of collectionDayData) {
        if (day.dayName === collectionDaySelect.value) {
            selectedDay = day.dayValue;
            break;
        }
    }

    if (
        selectedDay - presentWeekDay === 1 &&
        presentTime < collectionTimeData[2].lastHour
    ) {
        for (let collectionTime of collectionTimeData) {
            if (collectionTime.lastHour > presentTime) {
                addTimeOption(
                    collectionTime.firstHour,
                    collectionTime.lastHour
                );
            }
        }
    } else {
        for (let collectionTime of collectionTimeData) {
            addTimeOption(collectionTime.firstHour, collectionTime.lastHour);
        }
    }
}

function addTimeOption(firstHour, lastHour) {
    const optionElement = document.createElement('option');
    optionElement.setAttribute('value', `${firstHour}-${lastHour}`);
    optionElement.innerHTML = `${firstHour}-${lastHour}`;

    collectionTimeSelect.appendChild(optionElement);
}

function addDayOption(day, optionalNextWeek) {
    const optionElement = document.createElement('option');
    optionElement.setAttribute('value', day);
    optionElement.textContent = `${optionalNextWeek} ${day}`;

    return optionElement;
}
