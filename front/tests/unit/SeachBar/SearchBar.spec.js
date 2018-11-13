import { shallowMount } from '@vue/test-utils'
import SearchBar from '@/components/SearchBar'

describe('SearchBar', () => {
  it('should render properly', async () => {
    const wrapper = shallowMount(SearchBar, {
      propsData: {
        keywords: [
          { id: 1, name: 'KW1' },
          { id: 1, name: 'KW2' },
          { id: 1, name: 'KW3' }
        ],
        value: [{ id: 1, name: 'KW1' }]
      }
    })

    expect(wrapper.html()).toMatchSnapshot()
  })
})
