import React from 'react'
import Layout from './components/layout'
import api from '../src/services/api'

function Empresa({ page }){
  
  return(<>
  <Layout>
  <div id="breadcrumb">
    <div className="container">
        <div className="mb-4">
            <h1 className="head-after">Sobre</h1>
        </div>
        <nav>
            <ol>
                <li className="breadcrumb-item"><a href="index.html"><i className="mdi mdi-home mdi-36px"></i></a></li>
                <li className="breadcrumb-item active">Sobre a 7DTECH</li>
            </ol>
        </nav>
    </div>
</div>
<div id="who-we-are">
		<div className="container">
			<div className="row d-flex align-items-center">
				
    			<div className="col-lg-6">
    				<div className="video-btn">
	                    <div className="img-bg">
	                    	<div className="img-bg-1">
	    						<img src="static/assets/template/7dtechlayout/assets/images/img-1.jpg" alt="" />
	    					</div>
	    					<div className="img-bg-2">
	    						<img src="static/assets/template/7dtechlayout/assets/images/img-2.jpg" alt="" />
	    					</div>
		                </div>
                	</div>
    			</div>
				<div className="col-lg-6">
					<div className="about-us">
						<div className="about-us-content">
							<div className="mb-3">
								<h3 className="head-after">{page.page}</h3>
							</div>
		    				<h1>{page.title}</h1>
		    				<p>{page.description}</p>
		    				<div className="mb-4">
		    					<img src={page.img_url} alt="" />
		    				</div>
	    				</div>
    				</div>
    			</div>
				<div className="col-lg-12 mt-4 mb-2">
    				<div className="row">
    					<div className="col-lg-4">
    						<div className="card mb-0">
    							<div className="row d-flex align-items-center">
    								<div className="col-lg-3">
    									<i className="mdi mdi-certificate mdi-48px"></i>
    								</div>
    								<div className="col-lg-9">
    									<h4 className="mb-2">Certificao</h4>
    									<p className="mb-0">ISO 9001:2015</p>
    								</div>
    							</div>
    						</div>
    					</div>
    					<div className="col-lg-4">
    						<div className="card mb-0">
    							<div className="row d-flex align-items-center">
    								<div className="col-lg-3">
    									<i className="mdi mdi-account-convert mdi-48px"></i>
    								</div>
    								<div className="col-lg-9">
    									<h4 className="mb-2">Fala Conosco</h4>
    									<p className="mb-0">contato@7dtech.com.br</p>
    								</div>
    							</div>
    						</div>
    					</div>
    					<div className="col-lg-4">
    						<div className="card card-active mb-0">
    							<div className="row d-flex align-items-center">
    								<div className="col-lg-3">
    									<i className="mdi mdi-phone mdi-48px"></i>
    								</div>
    								<div className="col-lg-9">
    									<h4 className="mb-2">Atendimento</h4>
    									<p className="mb-0">+55 41 3232-3232</p>
    								</div>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
			</div>
		</div>
	</div>
	<div id="new-project" className="new-project-bg">
		<div className="container">
			<div className="row d-flex align-items-center">

				<div className="col-lg-10 text-left">
					<h1 className="mb-2">VOCÊ QUER EDIFÍCIO DOS SONHOS SEGURO HOJE?</h1>
					<p className="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				</div>
				<div className="col-lg-2 text-right">
					<a className="btn btn-white" href="#">Saiba Mais</a>
				</div>

			</div>
		</div>
	</div>
  </Layout>
  </>)
}

Empresa.getInitialProps = async () => {
	const response = await api.get('manage/pages/sobre')
	return {
		page: response.data
	}
}

export default Empresa
