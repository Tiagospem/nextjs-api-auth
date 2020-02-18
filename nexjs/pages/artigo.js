import React from 'react'
import Layout from './components/layout'
import Link from 'next/link'
import api from '../src/services/api'

export default function Artigo({
	artigo
}){
  
  return(<>
  <Layout>
  <div id="breadcrumb">
    <div className="container">
        <div className="mb-4">
            <h1 className="head-after">Artigo</h1>
        </div>
        <nav>
            <ol>
                <li className="breadcrumb-item"><a href="index.html"><i className="mdi mdi-home mdi-36px"></i></a></li>
                <li className="breadcrumb-item active">{artigo.title}</li>
            </ol>
        </nav>
    </div>
</div>

	<div id="blog">
		<div className="container"> 
			<div className="row">

	
      <div className="col-lg-12 mb-5">
					<div className="text-left">
						<h1 className="head-after">{artigo.title}</h1>
					</div>
				</div>

				<div className="col-lg-12">
					<div className="position-realtive">
						<div className="mb-3">
							<img className="w-100" src="/static/assets/template/7dtechlayout/assets/images/projects/img-7.jpg" alt="" />
						</div>
						<div className="project-single">
							<div className="card card-active">
								<p className="alinha-texto">{artigo.description}</p>
							</div>
						</div>
					</div>
				</div>

				<div className="col-lg-12">
				<div className="blog-footer">
							<Link href={`/artigos`}><a className="btn btn-sm btn-primary">Voltar</a></Link>
				</div>
				</div>
	
			</div> 
		</div>
	</div>
  </Layout>
  </>)
}
Artigo.getInitialProps = async ({query}) => {
	const artigo = await api.get(`manage/artigo/${query.slug}`)
	return {
		artigo: artigo.data
	}
}