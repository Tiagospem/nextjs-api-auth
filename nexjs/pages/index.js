import React, {useEffect, useState} from 'react';
import Head from 'next/head'
import Link from 'next/link'
import Layout from './components/layout'
import {Cookies} from 'react-cookie'

import api from '../src/services/api';

const cookies = new Cookies();

export default function index() {

  const [token, setToken] = useState()


  useEffect(() => {
    setToken(cookies.get('token') || null)
  })


  async function login(){
    await api.post('login', {
      email: 'tiagospem@gmail.com',
      password: '1415142asd.'
    }).then(response => {
      const tk = response.data.access_token;
      cookies.set('token', tk)
      setToken(tk)
      console.log(response.data)
    }).catch(error => {
      console.log(error);
    })
  }

  return (
    <Layout>
      <Head>
        <title>Teste pagina</title>
      </Head>
        <div>pagina inicial</div>
        <div>token: {token}</div>
        <button onClick={ () => login()}>Efetuar login no servidor...</button>
        <br />
        <br />
        <Link href="/seguro">
          <a>Página segura...</a>
        </Link>
    </Layout>
  );
};