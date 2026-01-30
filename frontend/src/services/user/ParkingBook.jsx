import axiosClient from '../Api'

export const getParkingHistories = ({limit = '', search = '', perPage = 10}) => {
  const url = `/parking-histories?search=${search}&perPage=${perPage}&limit=${limit}`
  return axiosClient.get(url, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  });
};

export const createParkingBook = (data) => {
  return axiosClient.post('/book', data, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  });
};
export const checkout = (id) => {
  return axiosClient.post(`/checkout/${id}`, {}, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  });
};