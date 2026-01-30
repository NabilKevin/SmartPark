import axiosClient from '../Api'

export const getParkingLots = ({limit = '', search = '', perPage = 10, page = 1, filterStatus}) => {
  const url = `/parking-lots?search=${search}&perPage=${perPage}&limit=${limit}&page=${page}&status=${filterStatus}`
  return axiosClient.get(url, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  });
};