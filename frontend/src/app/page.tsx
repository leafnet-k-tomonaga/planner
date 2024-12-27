'use client';

import styles from './page.module.css';
import { useState } from 'react';
import useSWR from 'swr';
import axios from '@/libs/axios';

export default function Sample(){
  const { data, error } = useSWR('api/sample', () => 
    axios
      .get('/api/sample')
      .then((res: any) => res.data)
  )

  if(error) return <div>エラーが発生しました。</div>
  if(!data) return <div>読み込み中</div>

  return(
    <div>
      <h1>NextでLaravelから取得したデータ::::{data}</h1>
    </div>
  );
}