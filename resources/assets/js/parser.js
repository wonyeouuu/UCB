import _ from 'lodash'
import { symptoms, MRI } from './options'

// export const symptomParser = value => symptoms[_.findKey(symptoms, { value })].text
export const symptomParser = value => symptoms[value - 1].text
export const mriParser = value => value.map(index => MRI[index - 1].text).join('/')
