import axiosClient from '../Api'

export const getParkingLots = () => {
  return axiosClient.get(`/dashboard/parking-lots/`, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  });
}

export const getParkingSpots = (page = 1, perPage = 10, search = '', filterByLot = '', filterByStatus = '') => {
  let url = `/dashboard/parking-spots?page=${page}&perPage=${perPage}&search=${search}`
  if(filterByLot !== '') {
    url += `&lot=${filterByLot}`
  }
  if(filterByStatus !== '') {
    url += `&status=${filterByStatus}`
  }
  return axiosClient.get(url, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  });
}

export const activateParkingSpot = (id) => {
  return axiosClient.post(`/dashboard/parking-spots/activate/${id}`, {}, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  });
}
export const deactivateParkingSpot = (id, data) => {
  return axiosClient.post(`/dashboard/parking-spots/deactivate/${id}`, data, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  });
}

export const updateParkingSpots = (id, data) => {
  console.log(id);
  
  return axiosClient.put(`/dashboard/parking-spots/${id}`, data, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  });
}
export const createParkingSpots = (data) => {
  if(data.hasOwnProperty('custom_number') && data.custom_number !== '') {
    data.custom_number = data.custom_number.split(',')
  }
  return axiosClient.post(`/dashboard/parking-spots`, data, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  });
}