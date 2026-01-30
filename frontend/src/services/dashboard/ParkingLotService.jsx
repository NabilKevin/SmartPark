import axiosClient from '../Api'

export const getParkingLots = (page = 1, perPage = 10, search = '', filterByStatus = '') => {
  let url = `/dashboard/parking-lots/all?page=${page}&perPage=${perPage}&search=${search}`
  if(filterByStatus !== '') {
    url += `&status=${filterByStatus}`
  }
  return axiosClient.get(url, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  });
}

export const activateParkingLot = (id) => {
  return axiosClient.post(`/dashboard/parking-lots/activate/${id}`, {}, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  });
}
export const deactivateParkingLot = (id, data) => {
  return axiosClient.post(`/dashboard/parking-lots/deactivate/${id}`, data, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  });
}

export const updateParkingLots = (id, data) => {
    return axiosClient.put(`/dashboard/parking-lots/${id}`, data, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  });
}
export const createParkingLots = (data) => {
    return axiosClient.post(`/dashboard/parking-lots`, data, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  });
}