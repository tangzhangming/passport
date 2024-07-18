import axios from 'axios';
// import { useRoute, useRouter } from "vue-router";

// const router = useRouter(); //这儿用不了这玩意儿 直接跳转吧


const service = axios.create({
	baseURL: 'https://passport.520.com/web-api/',
	// 允许跨域请求携带cookie
  	withCredentials: true,
  	// 请求超时时间
  	timeout: 5000
});


service.interceptors.response.use(
	response => {
		const res = response.data

		if( res.code == 401 ){
			location.href = '/401';
			return false;
		}

		return response;
	},

	// 非200请求进入这里
	error => {
		var response = error.response;

	    return Promise.reject(error);
	}
)

export default service