import { shallowMount } from '@vue/test-utils'
import TheSignIn from '@/views/TheSignIn'

describe('TheSignIn', () => {
  it('should render properly', () => {
    const wrapper = shallowMount(TheSignIn)

    expect(wrapper.html()).toMatchSnapshot()
  })
})
