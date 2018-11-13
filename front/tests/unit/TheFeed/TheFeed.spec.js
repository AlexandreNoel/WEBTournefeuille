import { shallowMount } from '@vue/test-utils'
import TheFeed from '@/views/TheFeed'

describe('TheFeed', () => {
  it('should render properly when user have keywords', async () => {
    const wrapper = shallowMount(TheFeed, {
      mocks: {
        $store: {
          state: {
            user: {
              id: 1,
              pseudo: 'Test',
              keywords: ['a', 'b', 'c']
            }
          },
          getters: {
            isAuthenticated: true
          },
          commit: jest.fn()
        },
        $api: {
          getUserInfo () {
            return Promise.resolve()
          }
        }
      },
      data () {
        return {
          bars: [
            {
              id: 1,
              name: 'Bar 1',
              address: '1 rue',
              keywords: ['b'],
              photoreference: 'ref',
              rating: '4.4'
            }
          ]
        }
      }
    })
    await wrapper.vm.$nextTick()

    expect(wrapper.html()).toMatchSnapshot()
  })
})
