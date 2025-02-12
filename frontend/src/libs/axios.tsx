import Axios from 'axios';

const axios = Axios.create({
    baseURL: process.env.NEXT_PUBLIC_BACKEND_API_BASE_URL,
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
    },
    withCredentials: true,
});

export default axios;