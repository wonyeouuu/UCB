import Vue from 'vue'
export const fetchReminders = ({ dispatch }) => {
    Vue
        .http
        .get('/reminder')
        .then(({ data }) => {
            dispatch('FETCH_REMINDERS', data)
        })
        .catch(console.log.bind(console))
}

export const fetchRecords = ({ dispatch }) => {
    Vue
        .http
        .get('/record')
        .then(({ data }) => {
            dispatch('FETCH_RECORDS', data)
        })
        .catch(console.log.bind(console))
}
