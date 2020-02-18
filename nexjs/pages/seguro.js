import React from 'react'
import Head from 'next/head'
import { Cookies } from 'react-cookie'
import Layout from './components/layout'
import api from '../src/services/api'
import { handleAuthSSR } from '../src/utils/auth';

const cookies = new Cookies();

export default function Seguro() {

  async function ping(){
    const token = cookies.get('token')
    try {
      const res = await api('ping', { headers: { 'Authorization': `Bearer ${token}` } });
      console.log(res.data.msg);
    } catch (err) {
      console.log(err.response.data);
    }
  }

  return (
    <Layout>
      <Head>
        <title>Pagina restrita</title>
      </Head>
        <div>página restrita</div>
        <button onClick={(e) => ping()}>Ping Call</button>
    </Layout>
  );
};

// Server-Side Rendering
Seguro.getInitialProps = async (ctx) => {
  // Must validate JWT
  // If the JWT is invalid it must redirect
  // back to the main page. You can do that
  // with Router from 'next/router
  await handleAuthSSR(ctx);

  // Must return an object
  return {}
}