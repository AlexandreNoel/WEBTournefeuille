import { shallowMount } from '@vue/test-utils'
import TheHome from '@/views/TheHome'

describe('TheHome', () => {
  it('should render properly', () => {
    const wrapper = shallowMount(TheHome, {
      mocks: {
        $store: {
          dispatch: jest.fn(),
          state: {
            keywords: ['a', 'b', 'c', 'd', 'e']
          }
        }
      },
      data () {
        return {
          selectedKeywords: ['a']
        }
      }
    })

    expect(wrapper.html()).toMatchSnapshot()
  })
})
