import axiosClient from '../Api'

export const getUsers = (page = 1, perPage = 10, search = '', filterByRole = '') => {
  let url = `/dashboard/users?page=${page}&perPage=${perPage}&search=${search}`
  if(filterByRole !== '') {
    url += `&role=${filterByRole}`
  }
  
  return axiosClient.get(url, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  });
}

export const updateUsers = (id, data) => {
  return axiosClient.put(`/dashboard/users/${id}`, data, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  });
}
export const updateUser = (data) => {
  return axiosClient.put(`/update-profile`, data, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  });
}
export const createUsers = (data) => {
  return axiosClient.post(`/dashboard/users`, data, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  });
}

export const deleteUser = (id) => {
  return axiosClient.delete(`/dashboard/users/${id}`, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  });
}

export const me = () => {
  return axiosClient.get(`/me`, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  });
}