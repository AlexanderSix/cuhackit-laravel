
/*************************************************************
 *
 * The API Helper - api.js
 *
 * This file is where the get, post, put, and delete (del)
 * methods live. Any Vue template that needs to send
 * any of these types of requests just has to include
 * this file inside the <script> tags using the following
 * template:
 *
 * import { [method-name] } from ' [filepath to this file] '
 *
 ************************************************************/

import axios from 'axios';

/**
 * Sends an HTTP GET request
 * @param  {String} url          The API endpoint
 * @param  {String} [token=null] The local bearer token (defaults to null)
 */
export function get(url, token = null) {

  return axios({
    method: 'GET',
    url,
    headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer '  + token,
    }
  });
}

/**
 * Sends an HTTP POST request
 * @param  {String} url          The API endpoint
 * @param  {Object} payload      The object to be POSTed to the server
 * @param  {String} [token=null] The local bearer token (defaults to null)
 */
export function post(url, payload, token = null) {
  return axios({
    method: 'POST',
    url,
    data: payload,
    headers: {
      'Accept': 'application/json',
      'Authorization': `Bearer ` + token,
    }
  });
}

/**
 * Sends an HTTP DELETE request
 * @param  {String} url          The API endpoint
 * @param  {String} [token=null] The local bearer token (defaults to null)
 */
export function del(url, token = null) {
  return axios({
    method: 'DELETE',
    url,
    headers: {
      'Accept': 'application/json',
      'Authorization': `Bearer ` + token,
    }
  });
}

/**
 * Sends an HTTP PUT request
 * @param  {String} url          The API endpoint
 * @param  {Object} payload      The object to be PUT to the server
 * @param  {String} [token=null] The local bearer token (defaults to null)
 */
export function put(url, payload, token = null) {
  return axios({
    method: 'PUT',
    url,
    data: payload,
    headers: {
      'Accept': 'application/json',
      'Authorization': `Bearer ` + token
    }
  });
}

export function upload(url, file, token=null, name="file") {

  if (typeof url !== 'string') {
    throw new TypeError('Expected a string, got ' + typeof url);
  }

  const config = {
    headers: {
      'Accept': 'application/json',
      'Authorization': `Bearer ` + token,
      'content-type': 'multipart/form-data'
    }
  }

  return axios.post(url, file, config);
}

export function interceptors(cb) {
  axios.interceptors.response.use((res) => {
    return res;
  }, (err) => {
    cb(err);
    return Promise.reject(err);
  });
}
