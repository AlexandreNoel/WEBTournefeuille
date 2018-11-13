import mockAxios from 'jest-mock-axios'
import Api from '../../../src/api/index'
// mock is in __mock__ directory

describe('Api', () => {
  beforeEach(() => {
    Api.install(MockVue)
  })

  it('should call /api/keywords api', done => {
    const mockVue = new MockVue()

    mockVue.$api.getBar(1)
      .then(msg => {
        expect(msg).toBe('awesome response')
        done()
      })

    expect(mockAxios.get).toHaveBeenCalledWith('/api/bars/1')

    mockAxios.mockResponse({ data: 'awesome response' })
  })
})

class MockVue {}
