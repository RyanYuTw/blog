<style>
	.tab-bar {
		list-style: none;
		margin: 0;
	}
	.tab-bar:before,
	.tab-bar:after {
		display: table;
		line-height: 0;
		content: "";
	}
	.tab-bar:after {
		clear: both;
	}
	.tab-bar.right > li {
		float: right;
	}
	.tab-bar.right > li.active:first-child a {
		border-right: none;
	}
	.tab-bar.grey-tab {
		background: #e6e6e6;
		padding: 0;
	}
	.tab-bar.grey-tab li.active a {
		border: transparent;
		background: #f9f9f9;
	}
	.tab-bar.grey-tab li.active a:hover,
	.tab-bar.grey-tab li.active a:focus {
		border: transparent;
	}
	.tab-bar.grey-tab li a {
		color: #bbb;
		border-radius: 0px;
		-moz-border-radius: 0px;
		-webkit-border-radius: 0px;
		border: transparent;
		text-shadow: 0 1px 0 #fff;
	}
	.tab-bar.bg-primary li:not(.active) a,
	.tab-bar.bg-info li:not(.active) a,
	.tab-bar.bg-success li:not(.active) a,
	.tab-bar.bg-warning li:not(.active) a,
	.tab-bar.bg-danger li:not(.active) a {
		color: #fff;
		text-shadow: none;
		transition: color 0.2s ease;
		-webkit-transition: color 0.2s ease;
		-moz-transition: color 0.2s ease;
		-ms-transition: color 0.2s ease;
		-o-transition: color 0.2s ease;
	}
	.tab-bar.bg-primary li:not(.active) a:hover,
	.tab-bar.bg-info li:not(.active) a:hover,
	.tab-bar.bg-success li:not(.active) a:hover,
	.tab-bar.bg-warning li:not(.active) a:hover,
	.tab-bar.bg-danger li:not(.active) a:hover,
	.tab-bar.bg-primary li:not(.active) a:focus,
	.tab-bar.bg-info li:not(.active) a:focus,
	.tab-bar.bg-success li:not(.active) a:focus,
	.tab-bar.bg-warning li:not(.active) a:focus,
	.tab-bar.bg-danger li:not(.active) a:focus {
		color: #eee;
		transition: color 0.2s ease;
		-webkit-transition: color 0.2s ease;
		-moz-transition: color 0.2s ease;
		-ms-transition: color 0.2s ease;
		-o-transition: color 0.2s ease;
	}
	.tab-bar > li {
		display: inline-block;
		float: left;
		margin-bottom: -1px;
	}
	.tab-bar > li.active:first-child a {
		border-left: none;
	}
	.tab-bar > li.active a {
		background: #fff;
		color: #777;
	}
	.tab-bar > li a {
		display: block;
		padding: 10px;
		color: #ccc;
		text-shadow: 0 1px #fff;
		transition: color 0.2s ease;
		-webkit-transition: color 0.2s ease;
		-moz-transition: color 0.2s ease;
		-ms-transition: color 0.2s ease;
		-o-transition: color 0.2s ease;
	}
	.tab-bar > li a:hover,
	.tab-bar > li a:focus {
		text-decoration: none;
		color: #777;
		transition: color 0.2s ease;
		-webkit-transition: color 0.2s ease;
		-moz-transition: color 0.2s ease;
		-ms-transition: color 0.2s ease;
		-o-transition: color 0.2s ease;
	}

	.progress {
		border-radius: 10px;
		-moz-border-radius: 10px;
		-webkit-border-radius: 10px;
		height: 12px;
	}
	.progress .progress-bar {
		background-color: #6bafbd;
	}
	.progress .progress-bar.animated-bar {
		animation: progress-start 3s linear;
		-webkit-animation: progress-start 3s linear;
		-moz-animation: progress-start 3s linear;
		-ms-animation: progress-start 3s linear;
		-o-animation: progress-start 3s linear;
	}
	.progress .progress-bar.progress-bar-success {
		background-color: #65cea7;
	}
	.progress .progress-bar.progress-bar-warning {
		background-color: #f3ce85;
	}
	.progress .progress-bar.progress-bar-danger {
		background-color: #fc8675;
	}

	.headline {
		margin: 20px 0;
		padding: 5px 0 10px 0;
		border-bottom: 1px solid #eee;
		font-weight: 500;
	}
	.headline.dark {
		border-bottom: 1px solid #1a1a1a;
	}
	.headline .line {
		display: block;
		height: 3px;
		background: #3c8dbc;
		margin-top: 7px;
		margin-bottom: -10px;
		width: 50px;
	}
</style>

<div>
	<ul class="tab-bar grey-tab">
		<li class="active">
			<a href="#overview" data-toggle="tab">
				<span class="block text-center">
					<i class="fa fa-home fa-2x"></i> 
				</span>
				總覽/Overview
			</a>
		</li>
		<li>
			<a href="#info" data-toggle="tab">
				<span class="block text-center">
					<i class="fa fa-user fa-2x"></i> 
				</span>
				基本資料/Info
			</a>
		</li>
		<li>
			<a href="#resume" data-toggle="tab">
				<span class="block text-center">
					<i class="fa fa-book fa-2x"></i> 
				</span>	
				履歷/Resume
			</a>
		</li>
	</ul>
</div>

<br/>

<div class="padding-md">
	<div class="row">
		<div class="col-md-3 col-sm-3">
			<div class="row">
				<div class="col-xs-6 col-sm-12 col-md-6 text-center">
					<a href="#">
						<img src="../img/me.jpg" alt="User Avatar" class="img-thumbnail">
					</a>
					<div class="seperator"></div>
					<div class="seperator"></div>
				</div>
				<div class="col-xs-6 col-sm-12 col-md-6">
					<strong class="font-14">余丁榮</strong>
					<small class="block text-muted">
						cecyu.tw@gmail.com
					</small> 
				</div>
			</div>
			
			<h5 class="headline">
				資訊技能自我評定
				<span class="line" style="width:100%;"></span>
			</h5>
			<dl>
				<dt>HTML <span class="pull-right">75%</span></dt>
				<dd>
					<div class="progress progress-striped">
						<div class="progress-bar progress-bar-success animated-bar" style="width:75%"></div>
					</div>
				</dd>
				<dt>Bootstrap <span class="pull-right">80%</span></dt>
				<dd>
					<div class="progress progress-striped">
						<div class="progress-bar progress-bar-info animated-bar" style="width:80%"></div>
					</div>
				</dd>					
				<dt>jQuery <span class="pull-right">70%</span></dt>
				<dd>
					<div class="progress progress-striped">
						<div class="progress-bar progress-bar-warning animated-bar" style="width:70%"></div>
					</div>
				</dd>
				<dt>PHP <span class="pull-right">90%</span></dt>
				<dd>
					<div class="progress progress-striped">
						<div class="progress-bar progress-bar-danger animated-bar" style="width:90%"></div>
					</div>
				</dd>
				<dt>SQL <span class="pull-right">90%</span></dt>
				<dd>
					<div class="progress progress-striped">
						<div class="progress-bar progress-bar-success animated-bar" style="width:90%"></div>
					</div>
				</dd>
			</dl>
		</div>

		<div class="col-md-9 col-sm-9">
			<div class="tab-content">
				<div class="tab-pane fade in active" id="overview">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default fadeInDown animation-delay2">
								<div class="panel-heading">
									<h4>關於我</h4>
								</div>
								<div class="panel-body">
									<ul>
										<li><h5>修習資訊管理及資訊工程領域</h5></li>
										<li><h5>擔任教師期間授課科目包括：資料庫實務、演算法原理與應用、...等資訊相關課程</h5></li>
										<li><h5>樂於學習、團隊合作</h5></li>
									</ul>
								</div>
							</div>

							<div class="panel panel-default fadeInDown animation-delay2">
								<div class="panel-heading">
									<h4>資訊技能</h4>
								</div>
								<div class="panel-body">
									<ul>
										<li><h5>專長後端 PHP, VB .NET 程式設計, 具 MySQL, MSSQL 資料庫規劃、設計能力</h5></li>
										<li><h5>熟悉 SQL 語法 Stored Procedure 也能上手</h5></li>
										<li><h5>具前端 Bootstrap, css, javascript, jquery 設計能力, 雖無法比擬專業前端設計師, 卻也能使頁面正常運作。</h5></li>
									</ul>
								</div>
							</div>

						</div>
					</div>
				</div>

				<div class="tab-pane fade in" id="info">						
					<div class="row">
						<div class="panel panel-info pull-right">
							<div class="panel-body">
								最後更新日期: 2021/04/20
							</div>
						</div>
					</div>
					
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4>基本資料</h4>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<label class="control-label col-md-2">姓名</label>												
								<div class="col-md-10">
									<label class="form-control" value="余丁榮">余丁榮</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2">電子郵件</label>
								<div class="col-md-10">
									<label class="form-control">cecyu.tw@gmail.com</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2">性別</label>
								<div class="col-md-10">
									<label class="form-control">男</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2">地址</label>
								<div class="col-md-10">
									<label class="form-control">桃園市中壢市莊敬路829巷10號11樓</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2">手機號碼</label>
								<div class="col-md-10">
									<label class="form-control">0918-803194</label>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="tab-pane fade in" id="resume">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default fadeInDown animation-delay2">
								<div class="panel-heading">
									<h4>自傳</h4>
								</div>
								<div class="panel-body">
									<p>自高中畢業後即報考國防管理學院投入軍旅，於資訊管理學系畢業後服務約24年，不管求學期間或工作期間，均擔任與資訊相關之教師(官)或行政職務，對資訊相關學能與技術有一定的基礎；另因教學研究所需，英文的聽說讀寫也具一定的能力；此外，在研究表現上，主持及參與國科會、國防部與北區健保局的研究計畫案均圓滿完成；在獨立作業上，開發業務所需應用/網頁資訊系統降低作業困難度；在團隊管理上，指導並帶領團隊分獲雲端專案管理競賽第一名及國科會研究創作獎。</p>  
									<p>茲將歷年主要職掌及工作成果分述如后：</p>
									<p>民國79年11月~84年7月，大學畢至碩士班入學期間</p>
									<ul>	
										<li>主要職掌：擔任行政與IBM 4341大型主機的操作員</li> 
										<li>主要成果：撰寫公文檢索與自動報表生成系統、撰寫軍事院校校友會理監事開票及監控系統</li> 
										<li>外語能力：參加托福考試，成績達軍方赴國外進修門檻</li> 
									</ul>	  
									<p>民國84年8月~92年8月，碩士畢至博士班期間</p>
									<ul>
										<li>
											電腦教學中心期間
											<ul>
												<li>主要職掌：負責電腦及網路維修、資料庫與3D max教學</li>
												<li>主要成果：完成管理學院創校80週年院刊編排、國軍軟體發展規範草案研編、管理學院院況多媒體簡介編修</li>
											</ul>
										</li>
										<br/>
										<li>
											資源管理研究所期間
											<ul>
												<li>碩士論文：混合式法定人數意見一致-在異質性分散式重覆性資料庫異動互斥之研究</li>
												<li>主要職掌：擔任講師兼助理，負責各項系務</li>
												<li>主要成果：建置該所專屬電腦教室與自費生研究室、承辦當年全國MBA慢速壘球比賽</li>
											</ul>
										</li>
										<br/>
										<li>
											博士班期間
											<ul>
												<li>主要成果：負責實驗室管理，協助指導教授指導4位在職碩士生論文、撰寫國科會研究計畫、承接北區健保局研究案、赴美發表學術論文</li>
												<li>博士論文：模糊限制代理人協商之對手行為模式學習</li>
											</ul>
										</li>
									</ul>  
									<p>民國92年9月~99年1月，軍職服務期間</p>  
									<ul>
										<li>國防管理教育中心期間
											<ul>
												<li>主要職掌：教官兼戰略班助理</li>
												<li>主要成果：教授課程包括：資訊戰、知識管理…等課程</li>
											</ul>
										</li>
										<li>電腦教學中心期間
											<ul>
												<li>主要職掌：系統維護組組長</li>
												<li>主要成果：兩次資訊設備搬遷案、新校區網路規劃及建置案、撰寫資訊設備籌補系統</li>
											</ul>
										</li>

									</ul> 
									<p>民國99年2月~103年8月，教師服務期間</p>
									<ul>
										<li>主要職掌：教學、研究、服務</li>
										<li>主要成果：
											<ul>
												<li>授課科目包括：資料庫實務、演算法原理與應用、電腦網路架構與管理、計算機組織與架構、數位化戰場管理、國防資訊系統專案實作、系統分析與設計…等課程</li>
												<li>協助辦理系所評鑑相關事宜，並通過系所評鑑</li>
												<li>承辦雲端運算研討會與協辦國防學術管理暨實務研討會</li>
												<li>指導大學部學生參加全國雲端專案管理競賽第一名</li>
												<li>指導大學部學生國科會大專生研究專題獲研究創作獎</li>
												<li>撰寫2013年國防管理學術暨實務研討會所需之報名系統與投、審稿系統</li>
												<li>連年獲國防部軍事教師研究補助案及國科會研究計畫案</li>
												<li>102年獲優良教師獎項</li>
												<li>撰寫國防部主計局101年綜合所得稅申報問卷調查暨統計系統</li>
												<li>指導研究生之研究主題主要包括：新聞資訊檢索、以文字為基礎之圖像檢索、數位學習主題地圖、資訊安全管理系統執行力檢測及風險管理、鏈結開放資料及網頁應用程式介面技術於知識檢索服務</li>
											</ul>
										</li>
									</ul>	  
									<p>民國103年9月~104年4月，耀聖科技股份公司服務期間</p>
									<ul>
										<li>主要職掌：系統分析師兼程式設計</li>
										<li>主要成果：負責新北市仁康醫院及竹北東元醫院所屬艾微芙診所醫療資訊系統系統分析及程式設計</li>
									</ul>
									<p>民國104年6月~106年9月，許園股份公司服務期間</p>
									<ul>
										<li>主要職掌：系統分析、程式設計、資料庫管理</li>
										<li>主要成果：負責電子商務所需零售及進銷存資訊系統之系統分析、程式設計與資料庫管理</li>
									</ul>
									<p>民國106年10月~109年10月，大麥網路股份有限公司服務期間</p>
									<ul>
										<li>主要職掌：API 及後台程式開發</li>
										<li>主要成果：負責發票、物流、簡訊與第三方串接，基於 Laravel 架構及 Laravel-admin 開發 POS 相關後台及 API, 程式語言為 php, 資料庫為 MySql</li>
									</ul>
									<p>民國109年11月~110年4月，脊椎滑脫復健中</p>
									<br/>
									<p>就業考量</p>
									<p>考量孩子就學經費所需及房屋貸款，決定放棄晉升高缺的機會，先行退伍謀取工作機會。</p> 
									<p>年齡是沒辦法改變的事實，或許經驗與態度可以彌補與一般年輕人的落差。不設定找工作之職業類別是期望自己不要侷限於同一領域；然而，即使同一專長領域也難保不會有一番新格局，基本上也不排斥。基於過去的工作、教學研究及團隊管理經歷，與在軍方的人格特質培養下，本人相信自己的加入能為貴公司帶來助力。感謝您撥冗閱讀本人簡歷自傳，至盼有與您進一步面談的機會，謝謝。</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>			
</div>
