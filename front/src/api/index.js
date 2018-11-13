import { bar } from './bar'
import { user } from './user'
import { admin } from './admin'
import { barList } from './barList'

const api = {
  ...bar,
  ...user,
  ...admin,
  ...barList
}

export default {
  install (Vue) {
    Vue.prototype.$api = api
  }
}
