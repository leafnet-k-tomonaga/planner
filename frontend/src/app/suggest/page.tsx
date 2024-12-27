'use client';

import styles from '../page.module.css';
import { useState } from 'react';
import useSWR from 'swr';
import axios from '@/libs/axios';

export default function Sample() {
    // form用の変数
    const [departurePlace, setDeparturePlace] = useState('');
    const [departureTime, setDepartureTime] = useState('');
    const [arrivalPlace, setArrivalPlace] = useState('');
    const [arrivalTime, setArrivalTime] = useState('');

    const [responseData, setResponseData] = useState(null);


    // form送信処理（formの送信ボタンを押すとこの処理が実行される）
    const handleSubmit = async (e: React.FormEvent) => {
        console.log('check1');
        // e.preventDefault();
        // try {
        //     const response = await axios.post('http://localhost:8000/api/suggests', {
        //         departureTime,
        //         departurePlace,
        //         arrivalTime,
        //         arrivalPlace,
        //     });
        //     setResponseData(response.data);

        //     console.log('Form submitted successfully:', response.data);
        // } catch (error) {
        //     console.error('Error submitting form:', error);
        // }
    };

    return (
        <div>
            <section>
                <h2>検索欄1</h2>
                <form onSubmit={handleSubmit} className={styles.form}>
                    <div>
                        <label htmlFor="departurePlace">出発地:</label>
                        <input
                            type="text"
                            id="departure"
                            value={departurePlace}
                            onChange={(e) => setDeparturePlace(e.target.value)}
                        />
                    </div>
                    <div>
                        <label htmlFor="departureTime">出発時間:</label>
                        <input
                            type="time"
                            id="departureTime"
                            value={departureTime}
                            onChange={(e) => setDepartureTime(e.target.value)}
                        />
                    </div>
                    <div>
                        <label htmlFor="arrivalPlace">帰着場所:</label>
                        <input
                            type="text"
                            id="arrivalPlace"
                            value={arrivalPlace}
                            onChange={(e) => setArrivalPlace(e.target.value)}
                        />
                    </div>
                    <div>
                        <label htmlFor="arrivalTime">帰着時間:</label>
                        <input
                            type="time"
                            id="arrivalTime"
                            value={arrivalTime}
                            onChange={(e) => setArrivalTime(e.target.value)}
                        />
                    </div>
                    <button type="submit">送信</button>
                </form>
            </section>



            <div style={{height: '50px'}}></div>
            <section>
                {responseData && (
                    <div className={styles.response}>
                        <h2>提案</h2>
                        <pre>{JSON.stringify(responseData, null, 2)}</pre>
                    </div>
                )}
            </section>
        </div>
    );
}