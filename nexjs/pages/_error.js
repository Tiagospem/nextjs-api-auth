import React from 'react';
import Head from 'next/head'
import Layout from './components/layout'

export default function index() {
  return (
    <Layout>
      <Head>
        <title>Erro</title>
      </Head>
        <div>Erro!</div>
    </Layout>
  );
};