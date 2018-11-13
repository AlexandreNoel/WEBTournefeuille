import axios from 'axios'

export const barList = {
  likedListBar (data) {
    return axios.post('/api/addbar', data)
  },
  blackListBar (data) {
    return axios.post('/api/addbar', data)
  }
}
