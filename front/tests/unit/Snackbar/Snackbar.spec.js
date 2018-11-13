import { shallowMount } from '@vue/test-utils'
import Snackbar from '@/components/Snackbar'

describe('Snackbar', () => {
  it('should render properly', () => {
    const wrapper = shallowMount(Snackbar)

    expect(wrapper.html()).toMatchSnapshot()
  })

  it('should render properly when info is call', async () => {
    const wrapper = shallowMount(Snackbar)

    wrapper.vm.info('Info...')
    await wrapper.vm.$nextTick()

    expect(wrapper.html()).toMatchSnapshot()
  })

  it('should render properly when success is call', async () => {
    const wrapper = shallowMount(Snackbar)

    wrapper.vm.success('Success...')
    await wrapper.vm.$nextTick()

    expect(wrapper.html()).toMatchSnapshot()
  })

  it('should render properly when warning is call', async () => {
    const wrapper = shallowMount(Snackbar)

    wrapper.vm.warning('Warning...')
    await wrapper.vm.$nextTick()

    expect(wrapper.html()).toMatchSnapshot()
  })

  it('should render properly when error is call', async () => {
    const wrapper = shallowMount(Snackbar)

    wrapper.vm.error('Error...')
    await wrapper.vm.$nextTick()

    expect(wrapper.html()).toMatchSnapshot()
  })
})
