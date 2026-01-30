import axiosClient from '../Api'

export const login = (data) => {
  return axiosClient.post(`/login`, data);
};
export const register = (data) => {
  return axiosClient.post(`/register`, data);
};
export const logout = () => {
  return axiosClient.post(`/logout`, {}, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  });
};