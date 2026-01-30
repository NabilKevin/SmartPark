import axiosClient from '../Api'

export const getSummary = () => {
  return axiosClient.get(`/dashboard/summary`, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  });
};