import axios from 'axios'

export const admin = {
  getComments () {
    return axios.get('/api/admin/comments')
      .then(res => res.data)
  },
  deleteCommentAdmin (id) {
    return axios.delete(`/api/comments/${id}`)
  }

}
