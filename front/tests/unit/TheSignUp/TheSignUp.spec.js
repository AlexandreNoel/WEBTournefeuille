import { shallowMount } from '@vue/test-utils'
import TheSignUp from '@/views/TheSignUp'

describe('TheSignUp', () => {
  it('should render properly', () => {
    const wrapper = shallowMount(TheSignUp)

    expect(wrapper.html()).toMatchSnapshot()
  })
})
