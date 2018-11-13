import { shallowMount } from '@vue/test-utils'
import TheSearch from '@/views/TheSearch'

describe('TheSearch', () => {
  it('should render an empty result', () => {
    const wrapper = shallowMount(TheSearch, {
      propsData: {
        query: { q: 'a,b,c' }
      },
      mocks: {
        $log: {
          debug: jest.fn()
        },
        $api: {
          getBars () {
            return Promise.resolve([])
          }
        },
        $store: {
          dispatch: jest.fn(),
          state: {
            keywords: ['a', 'b', 'c', 'd', 'e']
          }
        }
      }
    })

    expect(wrapper.html()).toMatchSnapshot()
  })

  it('should render a list of bars', async () => {
    const wrapper = shallowMount(TheSearch, {
      propsData: {
        query: { q: 'a,b,c' }
      },
      mocks: {
        $log: { debug: jest.fn() },
        $api: {
          getBars () {
            return Promise.resolve([
              {
                id: 1,
                name: 'Bar 1',
                address: '1 rue',
                keywords: ['b'],
                photoreference: 'ref',
                rating: '4.4'
              },
              {
                id: 2,
                name: 'Bar 2',
                address: '2 rue',
                keywords: ['a'],
                photoreference: 'ref',
                rating: '2.4'
              }
            ])
          }
        },
        $store: {
          dispatch: jest.fn(),
          state: {
            keywords: ['a', 'b', 'c', 'd', 'e']
          }
        }
      }
    })

    await wrapper.vm.$nextTick()

    expect(wrapper.html()).toMatchSnapshot()
  })
})
