import { shallowMount } from '@vue/test-utils'
import App from '@/App'

describe('App.vue', () => {
  it('should render properly when not authenticated', () => {
    const wrapper = shallowMount(App, {
      mocks: {
        $store: {
          getters: {
            isAuthenticated: false
          }
        }
      },
      stubs: ['router-link', 'router-view']
    })

    expect(wrapper.html()).toMatchSnapshot()
  })

  it('should render properly when authenticated', () => {
    const wrapper = shallowMount(App, {
      mocks: {
        $store: {
          getters: {
            isAuthenticated: true,
            isAdmin: true
          }
        }
      },
      stubs: ['router-link', 'router-view']
    })

    expect(wrapper.html()).toMatchSnapshot()
  })
})
