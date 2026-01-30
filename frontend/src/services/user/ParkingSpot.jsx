import axiosClient from '../Api'

export const getParkingSpots = ({search = '', perPage = 10, page = 1, filterStatus, id}) => {
  const url = `/parking-spots/${id}?search=${search}&perPage=${perPage}&page=${page}&status=${filterStatus}`
  
  return axiosClient.get(url, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  });
};