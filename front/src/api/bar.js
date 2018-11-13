import axios from 'axios'

export const bar = {
  getBars (query) {
    var kw = JSON.stringify(query.q).replace('"', '')
    return axios.get('/api/bars', {
      params: {
        keywords: kw.replace('"', '')
      }

    }).then(res => res.data)
  },
  getBar (id) {
    return axios.get('/api/bars/' + id)
      .then(res => res.data)
  },
  addBars (query) {
    var kw = JSON.stringify(query.q).replace('"', '')
    return axios.get('/api/addbar', {
      params: {
        keywords: kw.replace('"', '')
      }
    }).then(res => res.data)
  },
  addComment (idBar, comment) {
    return axios.post(`/api/bars/${idBar}/comments`, comment)
  },
  deleteComment (id, idBar) {
    return axios.delete(`/api/bars/${idBar}/comments/${id}`)
  },
  updateComment (id, idBar, comment) {
    return axios.put(`/api/bars/${idBar}/comments/${id}`, comment)
  },
  getComment (idUser, idBar) {
    return axios.get(`/api/bars/${idBar}/users/${idUser}/comments`)
  }
}
