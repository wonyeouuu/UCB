import _ from 'lodash'
import { symptoms, MRI } from './options'

export const symptomParser = arr => {
    return arr.map(symptom => symptoms[_.findIndex(symptoms, { value: parseInt(symptom, 10) })].text).join(', ')
}
export const mriParser = value => value.map(index => MRI[index - 1].text).join('/')
