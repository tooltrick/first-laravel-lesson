<?php
$attributes = array('class'	=> 'form-horizontal');

$hidden = array();

$user_name = array(
	'name'	=> 'user_name',
	'id'	=> 'user_name',
	'value'	=> set_value('user_name', ''),
);

$headline = array(
	'name'	=> 'headline',
	'id'	=> 'headline',
	'value'	=> set_value('headline', ''),
);

$content = array(
	'name'	=> 'content',
	'id'	=> 'content',
	'value'	=> set_value('content', ''),
	'class'	=> 'form-control',
	'placeholder'	=> '50字以上で入力して下さい。'
)
?>

<?php if($jsonld): ?>
<script type="application/ld+json">
    <?php echo $jsonld; ?>
</script>
<?php endif; ?>

<style type="text/css">
	.lbl.type8 {
		background-color: #fff;
		margin-right: 8px;
		padding: 3px 5px 2px;
		color: #f00;
		font-size: 12px;
		line-height: 1;
		border: 1px solid #f00;
		border-radius: 50px;
	}
</style>

<div>
	<div class="container u-title-block">
		<div class="title-block-left">
			<h1><?=$place['name']?></h1>
			<?php if ($place['cnt_comment'] > 0): ?>
			<div class="u-stars">
				<?php echo generate_star($place['rate_all']); ?>
				<span class="point"><?php echo number_format($place['rate_all'], 1, '.', ''); ?></span><span class="cnum"> <i class="fa fa-comment"> <span><span> <?=$place['cnt_comment']?></span>件</span></i></span>
			</div>
			<?php endif; ?>
		</div>
		<ul class="u-feature">
			<li class="<?php if ($place['flag_parking']): ?>on<?php endif; ?>"> 駐車場<br>あり</li>
			<li class="<?php if ($place['flag_kasou']): ?>on<?php endif; ?>"> 火葬施設<br>あり</li>
			<li class="<?php if ($place['flag_saijo']): ?>on<?php endif; ?>"> 自社斎場</li>
			<li class="<?php if ($place['flag_barrierfree']): ?>on<?php endif; ?>"> バリアフリー</li>
			<li class="<?php if ($place['flag_reserver']): ?>on<?php endif; ?>"> 生前予約</li>
			<li class="<?php if ($place['flag_anti']): ?>on<?php endif; ?>"> 安置施設<br>あり</li>
			<li class="<?php if ($place['flag_genre_onlinesogi']): ?>on<?php endif; ?>"> オンライン葬儀</li>
		</ul>
	</div>
	<article class="u-bg1 basic-info">

		<?php if($has_image):?>
		<div class="slkSld">
			<ul>
				<?php for($i = 1; $i <= 5; $i++):
					if($place['photo'.$i] && file_exists(FCPATH.PLACE_IMG_URL."/".$place['id']."_".$i.".".$place['photo'.$i])):
				?>
					<li class="slides">
						<div class="img"><img src="<?=site_url(PLACE_IMG_URL."/{$place['id']}_{$i}.{$place['photo'.$i]}")?>"></div>
					</li>
					<?php endif; ?>
				<?php endfor;?>
			</ul>
		</div>
		<?php endif;?>
		<div class="container">
			<?php if(!$place['non_affiliated_flag']): ?>
				<div class="btn-box" style="text-align:center;">
					<?php if($place["genre_b"] == 3): ?>
					<p class="fist-t"> ＼この寺院の資料をお送りします／ </p>
					<?php else: ?>
					<p class="fist-t"> ＼この葬儀会館の資料をお送りします／ </p>
					<?php endif; ?>
					<div class="pg-pref-btnTel"><a href="<?=site_url('/contact/contact_lp/');?>"><img src="<?php echo base_url("common/img/top/btn_document-02.png") ?>" alt=""/></a></div>
				</div>

				<div class="btn-box" style="text-align:center;">
					<div class="pg-pref-btnTel"><a href="tel:<?=get_tel_number()?>"><img src="<?php echo base_url("common/img/top/btn_tel_detail.png") ?>" alt=""/></a></div>
				</div>

			<br>
			<?php endif; ?>
			<div class="u-box1">
			<section>
				<h2 class="u-ttl2">基本情報</h2>
				<div class="row u-infoBox">
				<?php if($place['lat'] && $place['lng']):?>
				<dl class="col-lg-6 col-sm-12">
				<?php else: ?>
				<dl class="col-lg-12 col-sm-12">
				<?php endif;?>

					<dt> 所在地</dt>
					<dd> <?= $place['pref_name'] . ' ' . $place['area_name']?> </br>
							<?= $place['post']; ?><?= $place['address']; ?></dd>
					<?php if($place['station']):?>
					<dt> アクセス</dt>
					<dd> <?=$place['station']?></dd>
					<?php endif;?>

					<?php if($place['payment']):?>
					<dt> 支払い方法</dt>
					<dd> <?=$place['payment']?></dd>
					<?php endif;?>

					<?php if($place['business_hours']):?>
					<dt> 営業時間</dt>
					<dd> <?=$place['business_hours']?></dd>
					<?php endif;?>

					<?php if($place['holiday']):?>
					<dt> 定休日</dt>
					<dd> <?=$place['holiday']?></dd>
					<?php endif;?>

					<?php if($place['religious']):?>
					<dt> 宗教宗派</dt>
					<dd> <?=$place['religious']?></dd>
					<?php endif;?>

					<?php if($place['corporate_name']):?>
					<dt> 法人名</dt>
					<dd> <?=$place['corporate_name']?></dd>
					<?php endif;?>


				</dl>
				<?php if($place['lat'] && $place['lng']):?>
				<div class="map col-lg-6 col-sm-12">
					<div style="width: 100%;">
						<iframe width="100%" height="200px" frameborder="0" style="border:0"
src="https://www.google.com/maps/embed/v1/place?&language=ja&key=<?php echo GOOGLE_MAPS_API_KEY; ?>&q=<?php echo $place['lat']; ?>,<?php echo $place['lng']; ?>" ></iframe>
					</div>
				</div>
				<?php endif; ?>
				</div>
			</section>
			<?php if($place['article']):?>
			<section>
				<h2 class="u-ttl2"><?=$place['name']?>について</h2>
				<?= nl2br($place['article'])?>
			</section>
			<?php endif; ?>

			<?php if(!$place['non_affiliated_flag']): ?>
				<?php if(!($place["kasou_min_people_price"] || $place["kasou_max_people_price"] || $place["oneday_min_people_price"] || $place["oneday_max_people_price"] || $place["family_min_people_price"] || $place["family_max_people_price"] || $place["basic_min_people_price"] || $place["basic_max_people_price"])): ?>
				<?php echo $this->load->view('pc/parts/common/sogi_price', $this->data, TRUE); ?>
				<?php endif; ?>

				<?php echo $this->load->view('pc/parts/common/plan_list', $this->data, TRUE); ?>
			<?php else: ?>
				<section>
				<h2 class="u-ttl2"></h2>
				「やさしいお葬式」ではこちらの斎場と提携をしておりません。<br>
				「やさしいお葬式」ではこちらの斎場のご案内はできかねますので直接斎場にお問い合わせ下さい。
				</section>
			<?php endif; ?>

			</div>
		</div>
	</article>
	<?php if(!$place['non_affiliated_flag']): ?>
		<article class="u-bg1 basic-info plan-detail deplanZone">
			<?php
			if( $place["kasou_min_people_price"] || $place["kasou_max_people_price"] || $place["oneday_min_people_price"] || $place["oneday_max_people_price"] || $place["family_min_people_price"] || $place["family_max_people_price"] || $place["basic_min_people_price"] || $place["basic_max_people_price"]) {
			?>
			<div class="container">
				<div class="u-box1">
					<h2 class="u-ttl2"><?= $place["name"] ?>のお葬式プラン</h2>
					<div class="planBox">
						<div class="price-table plan-price-sp">
							<table class="">

								<colgroup>
									<col style="width:30%">
									<col style="width:70%">
								</colgroup>
								<?php if($place["kasou_min_people_price"] || $place["kasou_max_people_price"]){ ?>
								<tr>
									<td class="text-center" style="vertical-align: top;" >
										<?php if ($place['kasou_photo1'] || $place['kasou_photo2'] || $place['kasou_photo3']): ?>
											<?php for ($i=1; $i<=3; $i++): ?>
												<?php if ($place['kasou_photo'.$i]): ?>
												<img src="<?php echo site_url("images/place/{$place['id']}_kasou_photo{$i}.".$place['kasou_photo'.$i]); ?>" class="plan-price-img" />
												<?php
														break;
													endif;
												?>
											<?php endfor;?>
										<?php else: ?>
											<img src="<?php echo site_url('img/plan_pc_4.jpg'); ?>" class="plan-price-img" />
										<?php endif; ?>
										<div class="plan-pc-tt2">参列人数:
										<?php if ($place["kasou_min_people_price"]): ?><?=number_format($place["kasou_min_people_price"])?>人
										<?php endif; ?>〜
										<?php if ($place["kasou_max_people_price"]): ?>
											<?=number_format($place["kasou_max_people_price"])?>人
										<?php endif; ?>
										</div>
										<br>
										<img src="<?php echo site_url('img/plan_sp_status_001_2.jpg'); ?>" class="plan-price-stutus-img" />
									</td>
									<td style="vertical-align: top">
										<strong>式は行わず火葬のみ行うプラン</strong><br>
										<div class="plan-pc-tt1"><?=$place["name"]?>の火葬式</div>
										<?php if ($place["kasou_price"]): ?>
										<div class="price-txt plan-price-new"><?= number_format($place["kasou_price"]) ?>円（税込）〜</div>
										<?php endif; ?>
										<a class="u-btn1 sz1 plan-price-btn" href="<?php echo site_url('contact/'.$place['id'].'/4'); ?>">このプランでお見積り（無料）</a>
									</td>
								</tr>
								<?php } ?>

								<?php if($place["oneday_min_people_price"] || $place["oneday_max_people_price"]){ ?>
								<tr>
									<td class="text-center" style="vertical-align: top">

										<?php if ($place['oneday_photo1'] || $place['oneday_photo2'] || $place['oneday_photo3']): ?>
											<?php for ($i=1; $i<=3; $i++): ?>
												<?php if ($place['oneday_photo'.$i]): ?>
												<img src="<?php echo site_url("images/place/{$place['id']}_oneday_photo{$i}.".$place['oneday_photo'.$i]); ?>" class="plan-price-img" />
												<?php
														break;
													endif;
												?>
											<?php endfor;?>
										<?php else: ?>
											<img src="<?php echo site_url('img/plan_pc_1.jpg'); ?>" class="plan-price-img" />
										<?php endif; ?><br>
										<div class="plan-pc-tt2">参列人数:
										<?php if ($place["oneday_min_people_price"]): ?>
											<?=number_format($place["oneday_min_people_price"])?>人
										<?php endif; ?>
										〜
										<?php if ($place["oneday_max_people_price"]): ?>
											<?=number_format($place["oneday_max_people_price"])?>人
										<?php endif; ?>
										</div>
										<br>
										<img src="<?php echo site_url('img/plan_sp_status_011_2.jpg'); ?>" class="plan-price-stutus-img" />
									</td>
									<td style="vertical-align: top">
										<strong>通夜式は行わず、告別式と火葬式のみ行うプラン</strong><br>
										<div class="plan-pc-tt1"><?=$place["name"]?>の一日葬</div>
										<?php if ($place["oneday_price"]): ?>
										<div class="price-txt plan-price-new"><?= number_format($place["oneday_price"]) ?>円（税込）〜</div>
										<?php endif; ?>
										<a class="u-btn1 sz1 plan-price-btn" href="<?php echo site_url('contact/'.$place['id'].'/1'); ?>">このプランでお見積り（無料）</a>
									</td>
								</tr>
								<?php } ?>

								<?php if($place["family_min_people_price"] || $place["family_max_people_price"]){ ?>
								<tr>
									<td class="text-center" style="vertical-align: top">
										<?php if ($place['family_photo1'] || $place['family_photo2'] || $place['family_photo3']): ?>
											<?php for ($i=1; $i<=3; $i++): ?>
												<?php if ($place['family_photo'.$i]): ?>
												<img src="<?php echo site_url("images/place/{$place['id']}_family_photo{$i}.".$place['family_photo'.$i]); ?>" class="plan-price-img" />
												<?php
														break;
													endif;
												?>
											<?php endfor;?>
										<?php else: ?>
											<img src="<?php echo site_url('img/plan_pc_2.jpg'); ?>" class="plan-price-img" />
										<?php endif; ?><br>
										<div class="plan-pc-tt2">参列人数:
										<?php if ($place["family_min_people_price"]): ?>
											<?=number_format($place["family_min_people_price"])?>人
										<?php endif; ?>
										〜
										<?php if ($place["family_max_people_price"]): ?>
											<?=number_format($place["family_max_people_price"])?>人
										<?php endif; ?>
										</div>
										<br>
										<img src="<?php echo site_url('img/plan_sp_status_111_2.jpg'); ?>" class="plan-price-stutus-img" />
									</td>
									<td style="vertical-align: top">
										<strong>通夜式も告別式も行う一般的なプラン</strong><br>
										<div class="plan-pc-tt1"><?=$place["name"]?>の家族葬</div>
										<?php if ($place["family_price"]): ?>
										<div class="price-txt plan-price-new"><?= number_format($place["family_price"]) ?>円（税込）〜</div>
										<?php endif; ?>
										<a class="u-btn1 sz1 plan-price-btn" href="<?php echo site_url('contact/'.$place['id'].'/2'); ?>">このプランでお見積り（無料）</a>
									</td>
								</tr>
								<?php } ?>

								<?php if($place["basic_min_people_price"] || $place["basic_max_people_price"]){ ?>
								<tr>
									<td class="text-center" style="vertical-align: top">
										<?php if ($place['basic_photo1'] || $place['basic_photo2'] || $place['basic_photo3']): ?>
											<?php for ($i=1; $i<=3; $i++): ?>
												<?php if ($place['basic_photo'.$i]): ?>
												<img src="<?php echo site_url("images/place/{$place['id']}_basic_photo{$i}.".$place['basic_photo'.$i]); ?>" class="plan-price-img" />
												<?php
														break;
													endif;
												?>
											<?php endfor;?>
										<?php else: ?>
											<img src="<?php echo site_url('img/plan_pc_3.jpg'); ?>" class="plan-price-img" />
										<?php endif; ?><br>
										<div class="plan-pc-tt2">参列人数:
										<?php if ($place["basic_min_people_price"]): ?>
											<?=number_format($place["basic_min_people_price"])?>人
										<?php endif; ?>
										〜
										<?php if ($place["basic_max_people_price"]): ?>
											<?=number_format($place["basic_max_people_price"])?>人
										<?php endif; ?>
										</div>
										<br>
										<img src="<?php echo site_url('img/plan_sp_status_111_2.jpg'); ?>" class="plan-price-stutus-img" />
									</td>
									<td style="vertical-align: top">
										<strong>多くの参列者を招いて行う葬儀プラン</strong><br>
										<div class="plan-pc-tt1"><?=$place["name"]?>一般葬</div>
										<?php if ($place["basic_price"]): ?>
										<div class="price-txt plan-price-new"><?= number_format($place["basic_price"]) ?>円（税込）〜</div>
										<?php endif; ?>
										<a class="u-btn1 sz1 plan-price-btn" href="<?php echo site_url('contact/'.$place['id'].'/3'); ?>">このプランでお見積り（無料）</a>
									</td>
								</tr>
								<?php } ?>

							</table>
						</div>
						<?php $price_flg = FALSE; ?>
						<?php if(($place["kasou_price"] != 0 and $place["kasou_price"] != NULL) or ($place["basic_price"] != 0 and $place["basic_price"] != NULL) or ($place["oneday_price"] != 0 and $place["oneday_price"] != NULL) or ($place["family_price"] != 0 and $place["family_price"] != NULL)){ ?>
							<?php $price_flg = TRUE; ?>
						<?php } ?>
						<div class="price-table plan-price-pc">
							<table class="">
								<tr>
									<th></th>
									<th>プラン名</th>
									<?php if($price_flg == TRUE){ ?>
									<th>価格</th>
									<?php } ?>
									<th class="text-center">種別</th>
									<th class="text-center">お問い合わせ</th>
								</tr>
								<?php if($place["kasou_min_people_price"] || $place["kasou_max_people_price"]){ ?>
								<tr>
									<td>
										<?php if ($place['kasou_photo1'] || $place['kasou_photo2'] || $place['kasou_photo3']): ?>
											<?php for ($i=1; $i<=3; $i++): ?>
												<?php if ($place['kasou_photo'.$i]): ?>
												<img src="<?php echo site_url("images/place/{$place['id']}_kasou_photo{$i}.".$place['kasou_photo'.$i]); ?>" class="plan-price-img" />
												<?php
														break;
													endif;
												?>
											<?php endfor;?>
										<?php else: ?>
											<img src="<?php echo site_url('img/plan_pc_4.jpg'); ?>" class="plan-price-img" />
										<?php endif; ?>
									</td>
									<td>
										<strong>式は行わず火葬のみ行うプラン</strong><br>
										<div class="plan-pc-tt1"><?=$place["name"]?>の火葬式</div>
										<div class="plan-pc-tt2">参列人数:
										<?php if ($place["kasou_min_people_price"]): ?>
											<?=number_format($place["kasou_min_people_price"])?>人
										<?php endif; ?>
										〜
										<?php if ($place["kasou_max_people_price"]): ?>
											<?=number_format($place["kasou_max_people_price"])?>人
										<?php endif; ?>
										</div>
									</td>
									<?php if($price_flg == TRUE){ ?>
									<td>
										<?php if ($place["kasou_price"]): ?>
										<div class="price-txt"><?= number_format($place["kasou_price"]) ?>円（税込）〜</span>
										<?php endif; ?>
									</td>
									<?php } ?>

									<td class="text-center">
										<span class="plan-pc-btn-grey">通夜式</span><br>
										<span class="plan-pc-btn-grey MGT10">告別式</span><br>
										<span class="plan-pc-btn-green MGT10">火葬</span>
									</td>

									<td>
										<a class="u-btn1 sz1 plan-price-btn" href="<?php echo site_url('contact/'.$place['id'].'/4'); ?>">このプランでお見積り（無料）</a>
									</td>
								</tr>
								<?php } ?>

								<?php if($place["oneday_min_people_price"] || $place["oneday_max_people_price"]){ ?>
								<tr>
									<td>
										<?php if ($place['oneday_photo1'] || $place['oneday_photo2'] || $place['oneday_photo3']): ?>
											<?php for ($i=1; $i<=3; $i++): ?>
												<?php if ($place['oneday_photo'.$i]): ?>
												<img src="<?php echo site_url("images/place/{$place['id']}_oneday_photo{$i}.".$place['oneday_photo'.$i]); ?>" class="plan-price-img" />
												<?php
														break;
													endif;
												?>
											<?php endfor;?>
										<?php else: ?>
											<img src="<?php echo site_url('img/plan_pc_1.jpg'); ?>" />
										<?php endif; ?>
									</td>
									<td>
										<strong>通夜式は行わず、告別式と火葬式のみ行うプラン</strong><br>
										<div class="plan-pc-tt1"><?=$place["name"]?>の一日葬</div>
										<div class="plan-pc-tt2">参列人数:
										<?php if ($place["oneday_min_people_price"]): ?>
											<?=number_format($place["oneday_min_people_price"])?>人
										<?php endif; ?>
										〜
										<?php if ($place["oneday_max_people_price"]): ?>
											<?=number_format($place["oneday_max_people_price"])?>人
										<?php endif; ?>
										</div>
									</td>
									<?php if($price_flg == TRUE){ ?>
									<td>
										<?php if ($place["oneday_price"]): ?>
										<div class="price-txt"><?= number_format($place["oneday_price"]) ?>円（税込）〜</span>
										<?php endif; ?>
									</td>
									<?php } ?>

									<td class="text-center">
										<span class="plan-pc-btn-grey">通夜式</span><br>
										<span class="plan-pc-btn-green MGT10">告別式</span><br>
										<span class="plan-pc-btn-green MGT10">火葬</span>
									</td>

									<td>
										<a class="u-btn1 sz1 plan-price-btn" href="<?php echo site_url('contact/'.$place['id'].'/1'); ?>">このプランでお見積り（無料）</a>
									</td>
								</tr>
								<?php } ?>

								<?php if($place["family_min_people_price"] || $place["family_max_people_price"]){ ?>
								<tr>
									<td>
										<?php if ($place['family_photo1'] || $place['family_photo2'] || $place['family_photo3']): ?>
											<?php for ($i=1; $i<=3; $i++): ?>
												<?php if ($place['family_photo'.$i]): ?>
												<img src="<?php echo site_url("images/place/{$place['id']}_family_photo{$i}.".$place['family_photo'.$i]); ?>" class="plan-price-img" />
												<?php
														break;
													endif;
												?>
											<?php endfor;?>
										<?php else: ?>
											<img src="<?php echo site_url('img/plan_pc_2.jpg'); ?>" />
										<?php endif; ?>
									</td>
									<td>
										<strong>通夜式も告別式も行う一般的なプラン</strong><br>
										<div class="plan-pc-tt1"><?=$place["name"]?>の家族葬</div>
										<div class="plan-pc-tt2">参列人数:
										<?php if ($place["family_min_people_price"]): ?>
											<?=number_format($place["family_min_people_price"])?>人
										<?php endif; ?>
										〜
										<?php if ($place["family_max_people_price"]): ?>
											<?=number_format($place["family_max_people_price"])?>人
										<?php endif; ?>
										</div>
									</td>
									<?php if($price_flg == TRUE){ ?>
									<td>
										<?php if ($place["family_price"]): ?>
										<div class="price-txt"><?= number_format($place["family_price"]) ?>円（税込）〜</span>
										<?php endif; ?>
									</td>
									<?php } ?>

									<td class="text-center">
										<span class="plan-pc-btn-green">通夜式</span><br>
										<span class="plan-pc-btn-green MGT10">告別式</span><br>
										<span class="plan-pc-btn-green MGT10">火葬</span>
									</td>

									<td>
										<a class="u-btn1 sz1 plan-price-btn" href="<?php echo site_url('contact/'.$place['id'].'/2'); ?>">このプランでお見積り（無料）</a>
									</td>
								</tr>
								<?php } ?>

								<?php if($place["basic_min_people_price"] || $place["basic_max_people_price"]){ ?>
								<tr>
									<td>
										<?php if ($place['basic_photo1'] || $place['basic_photo2'] || $place['basic_photo3']): ?>
											<?php for ($i=1; $i<=3; $i++): ?>
												<?php if ($place['basic_photo'.$i]): ?>
												<img src="<?php echo site_url("images/place/{$place['id']}_basic_photo{$i}.".$place['basic_photo'.$i]); ?>" class="plan-price-img" />
												<?php
														break;
													endif;
												?>
											<?php endfor;?>
										<?php else: ?>
											<img src="<?php echo site_url('img/plan_pc_3.jpg'); ?>" />
										<?php endif; ?>
									</td>
									<td>
										<strong>多くの参列者を招いて行う葬儀プラン</strong><br>
										<div class="plan-pc-tt1"><?=$place["name"]?>の一般葬</div>
										<div class="plan-pc-tt2">参列人数:
										<?php if ($place["basic_min_people_price"]): ?>
											<?=number_format($place["basic_min_people_price"])?>人
										<?php endif; ?>
										〜
										<?php if ($place["basic_max_people_price"]): ?>
											<?=number_format($place["basic_max_people_price"])?>人
										<?php endif; ?>
										</div>
									</td>
									<?php if($price_flg == TRUE){ ?>
									<td>
										<?php if ($place["basic_price"]): ?>
										<div class="price-txt"><?= number_format($place["basic_price"]) ?>円（税込）〜</span>
										<?php endif; ?>
									</td>
									<?php } ?>

									<td class="text-center">
										<span class="plan-pc-btn-green">通夜式</span><br>
										<span class="plan-pc-btn-green MGT10">告別式</span><br>
										<span class="plan-pc-btn-green MGT10">火葬</span>
									</td>

									<td>
										<a class="u-btn1 sz1 plan-price-btn" href="<?php echo site_url('contact/'.$place['id'].'/3'); ?>">このプランでお見積り（無料）</a>
									</td>
								</tr>
								<?php } ?>
							</table>
						</div>


						<div class="ad-plan" style="padding: 0px">
							<div class="txt">
								<p class="notes">※火葬料金は別途お客様負担となります。<br>※各プラン表示価格は事前会員登録価格です。<br>※ご希望によっては対応できないプランがございます。詳細はお電話ください。</p><a class="showModal1 showModal" href="#">火葬料金の目安</a>
							</div>
							<div class="txt" style="margin-top: -4px;">
								<p class="notes"></p>
								<a class="showModal2 showModal" href="#">追加料金がかかる場合</a>
							</div>
						</div>

						<?php if ($place['appeal_text']): ?>
							<br><br><br><br>
							<?php echo nl2br($place['appeal_text']); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php
			}
			?>

			<?php if ($place['flag_buddhism'] || $place['flag_shinto'] || $place['flag_christianity'] || $place['flag_friend'] || $place['flag_countless']): ?>
				<div class="container">
					<div class="u-box1">
						<h3 id="ttl-54970" class="u-ttl3">対応宗派</h3>
						<div class="MGT10">
							<?php if ($place['flag_buddhism']): ?>
							<span class="plan-pc-btn-green">仏教</span>
							<?php else: ?>
							<span class="plan-pc-btn-grey">仏教</span>
							<?php endif; ?>

							<?php if ($place['flag_shinto']): ?>
							<span class="plan-pc-btn-green">神道</span>
							<?php else: ?>
							<span class="plan-pc-btn-grey">神道</span>
							<?php endif; ?>

							<?php if ($place['flag_christianity']): ?>
							<span class="plan-pc-btn-green">キリスト教</span>
							<?php else: ?>
							<span class="plan-pc-btn-grey">キリスト教</span>
							<?php endif; ?>

							<?php if ($place['flag_friend']): ?>
							<span class="plan-pc-btn-green">友人葬</span>
							<?php else: ?>
							<span class="plan-pc-btn-grey">友人葬</span>
							<?php endif; ?>

							<?php if ($place['flag_countless']): ?>
							<span class="plan-pc-btn-green">無宗教</span>
							<?php else: ?>
							<span class="plan-pc-btn-grey">無宗教</span>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<?php
			if( !($place["kasou_min_people_price"] || $place["kasou_max_people_price"] || $place["oneday_min_people_price"] || $place["oneday_max_people_price"] || $place["family_min_people_price"] || $place["family_max_people_price"] || $place["basic_min_people_price"] || $place["basic_max_people_price"]) ) {
			?>
			<div class="container">
				<div class="u-box1">
					<h2 class="u-ttl2">やさしいお葬式のプラン</h2>
					<div class="planBox">
						<ul class="tbl" style="text-align:center;">
							<li>
								<picture>
									<source srcset="<?php echo base_url("/common/img/top/cap.jpg") ?>" media="(max-width: 767px)" /><img src="<?php echo base_url("/common/img/top/cap.jpg") ?>" />
								</picture>
							</li>
							<li><a href="<?=site_url('/lp/owakaresoh/');?>">
								<picture>
									<source srcset="<?php echo base_url("/common/img/top/select01-sp.png") ?>" media="(max-width: 767px)" /><img src="<?php echo base_url("/common/img/top/select01.jpg") ?>" />
								</picture>
							</a></li>								
							<?php if(($place["genre_b"] ==3 ) || ($place["genre_b"] !=3 && $place["non_affiliated_flag"] ==1)) { ?>
								<?php if($place["sougi_zika_alternate_name"] == FALSE) {?>														
									<li><a href="<?=site_url('/lp/kasousiki/');?>">
										<picture>
											<source srcset="<?php echo base_url("/common/img/top/select02-sp.png") ?>" media="(max-width: 767px)" /><img src="<?php echo base_url("/common/img/top/select02.jpg") ?>" />
										</picture>
									</a></li>
								<?php }?>				 
							<?php }?>									
							<li><a href="<?=site_url('/lp/ichinichisoh/');?>">
								<picture>
									<source srcset="<?php echo base_url("/common/img/top/select03-sp.png") ?>" media="(max-width: 767px)" /><img src="<?php echo base_url("/common/img/top/select03.jpg") ?>" />
								</picture>
							</a></li>
							<li><a href="<?=site_url('/lp/kazokusoh/');?>">
								<picture>
									<source srcset="<?php echo base_url("/common/img/top/select04-sp.png") ?>" media="(max-width: 767px)" /><img src="<?php echo base_url("/common/img/top/select04.jpg") ?>" />
								</picture>
							</a></li>
							<li><a href="<?=site_url('/lp/ippansoh/');?>">
								<picture>
									<source srcset="<?php echo base_url("/common/img/top/select05-sp.png") ?>" media="(max-width: 767px)" /><img src="<?php echo base_url("/common/img/top/select05.jpg") ?>" />
								</picture>
							</a></li>
						</ul>

						<div class="ad-plan">
							<div class="txt">
								<p class="notes">※火葬料金は別途お客様負担となります。<br>※各プラン表示価格は事前会員登録価格です。<br>※ご希望によっては対応できないプランがございます。詳細はお電話ください。</p><a class="showModal1 showModal" href="#">火葬料金の目安</a>
							</div>
							<div class="txt" style="margin-top: -4px;">
								<p class="notes"></p>
								<a class="showModal2 showModal" href="#">追加料金がかかる場合</a>
							</div>
						</div>
					</div>

				</div>
			</div>
			<?php
			}
			?>

			<div class="btn-box" style="text-align:center;">
			<?php if($place["genre_b"] == 3 && $place["non_affiliated_flag"] !=1) { ?>
				<p class="fist-t"> ＼<?=$place['name']?> この寺院の資料をお送りします／ </p>
				<div class="pg-pref-btnTel"><a href="<?=site_url('/contact/contact_lp/');?>"><img src="<?php echo base_url("common/img/top/btn_document-02.png") ?>" alt=""/></a></div>
			<?php }else {?>
				<p class="fist-t"> ＼<?=$place['name']?> の資料をお送りします／ </p>
				<div class="pg-pref-btnTel"><a href="<?=site_url('/contact/contact_lp/');?>"><img src="<?php echo base_url("common/img/top/btn_document-02.png") ?>" alt=""/></a></div>
			<?php }?>
			</div>

			<div class="btn-box" style="text-align:center;">
				<div class="pg-pref-btnTel"><a href="tel:<?=get_tel_number()?>"><img src="<?php echo base_url("common/img/top/btn_tel_detail.png") ?>" alt=""/></a></div>
			</div>


			<?php if($place["genre_b"] != 3): ?>
			<div class="pg-pref-btnMnk"><a href="<?php echo base_url("lp/lp_obousan/") ?>"><img src="<?php echo base_url("common/img/top/btn_mnk.png") ?>" alt=""/></a></div>
			<?php endif; ?>

			<div class="btn-box" style="text-align:center;">
				<div class="pg-pref-btnTel"><a href="<?=site_url('/contact/contact_lp/');?>"><img src="<?php echo base_url("common/img/top/btn_book.png") ?>" alt=""/></a></div>
			</div>

		</article>
	<?php else: ?>
		<article class="u-bg1 basic-info plan-detail deplanZone">
		</article>
	<?php endif; ?>

	<?php if ($place_case_list): ?>
	<article>
		<div class="u-inner">
			<h2 class="u-ttl1"><span>葬儀事例</span></h2>

			<div class="container">
				<ul class="row">
					<?php foreach ($place_case_list as $item) : ?>
					<li class="col-lg-6 col-md-12 col-sm-12">
						<?php
							$thumbnail_url = site_url()."img/noimage.png";
							if($item["photo1"] && file_exists(FCPATH."images/place_case/".$item["id"]."_1_450.".$item["photo1"]))
							{
								$thumbnail_url = site_url()."images/place_case/".$item["id"]."_1_450.".$item["photo1"];
							}
						?>
						<div class="img" style="width:100%; height: auto;">
							<img style="max-height: none; width: 100%;" src="<?=$thumbnail_url?>" alt="<?=$item['heading']?>" title="">
						</div>
						<div class="txt" style="padding-top: 10px;">
							<p><?= $item['heading']?></p>
						</div>
						<div class="txt" style="padding-top: 10px; color: #b60202; font-weight: bold;">
							<p><?= number_format($item['price'])?>円（税込）</p>
						</div>
						<div class="txt" style="padding-top: 10px;">
							<p><?= nl2br($item['content'])?></p>
						</div>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</article>
	<?php endif; ?>

	<?php echo $this->load->view('pc/parts/common/estimated_cremation_fee', NULL, TRUE); ?>
	<?php echo $this->load->view('pc/parts/common/additional_fee', NULL, TRUE); ?>


	<article>

		<?php if (count($related_city) > 0 && count($related_pref) > 0): ?>
			<div class="u-inner related-pref">

				<div class="container">

					<section id="review-form">
						<h2 class="u-ttl1"><span>対応可能な地域</span></h2>
						<div class="u-box1 is-green ">
							<?php foreach ($related_pref as $pref): ?>
								<?php if (isset($related_city[$pref['id']]) && count($related_city[$pref['id']]) > 0): ?>
									<b><?=$pref['name']?></b><br>
									<?php foreach ($related_city[$pref['id']] as $city): ?>
										<span><?=$city['name']?></span>
									<?php endforeach; ?>
									<br><br>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					</section>
				</div>
			</div>
		<?php endif; ?>

		<?php if ($place['manager_voice']): ?>
			<div class="u-inner">
				<div class="container">
					<?php if($place["genre_b"] != 3){ ?>
						<h3 id="ttl-54970" class="u-ttl3">担当者の想い</h3>
					<?php }else{ ?>
						<h3 id="ttl-54970" class="u-ttl3">住職の想い</h3>
					<?php } ?>
					<div class="row">
						<?php //$place['manager_photo1']='';?>
						<?php if ($place['manager_photo1']): ?>
							<div class="col-md-4">
								<img src="<?php echo site_url("images/place/{$place['id']}_manager_photo1.".$place['manager_photo1']); ?>" />
							</div>
							<div class="col-md-8" >
								<p class="manager-txt"><?php echo nl2br($place['manager_voice']); ?></p>
							</div>
						<?php else: ?>
							<div class="col-md-12">
								<?php echo nl2br($place['manager_voice']); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<div class="u-inner">
			<div class="container">
			<section>
				<h2 class="u-ttl1"><span>みんなの口コミ</span></h2>
				<?php echo $this->load->view('pc/parts/common/reviews_list', $this->data, TRUE); ?>
			</section>

			<?php echo form_open($this->uri->uri_string().'#review-form', $attributes, $hidden); ?>
			<?=$this->csrf_simple->set_ticket("",'TRUE')?>
			<section id="review-form">
				<div class="u-box1 is-green">
				<h3 class="u-ttl2">口コミを投稿する</h3>
				<form>
					<?php if(!$user_id):?>
					<dl class="u-form-input">
						<dt class="must"> お名前（<span style="color:#FF0000"><strong>＊</strong></span>）</dt>
						<dd>
							<?php echo form_input($user_name);?>
							<?php echo form_error('user_name');?>
						</dd>
					</dl>
					<?php endif?>
					<dl class="u-form-input form-group">
						<dt class="must"> タイトル</dt>
						<dd>
							<?php echo form_input($headline);?>
							<?php echo form_error('headline');?>
						</dd>
					</dl>
					<dl class="u-form-input">
					<dt class="must"> 評価</dt>
					<dd>
						<ul class="starRateBox row">
							<li class="col-lg-3">
								<p>立地・アクセス</p>
								<p class="bg-danger hidden" id="rate_access_error"></p>
								<span class="star-rating">
									<?php
										$rate_access = set_value('rate_access', 0);
									?>
									<input type="radio" name="rate_access" value="1" <?php if($rate_access>=1): echo 'checked=checked'; endif; ?> /><i></i>
									<input type="radio" name="rate_access" value="2" <?php if($rate_access>=2): echo 'checked=checked'; endif; ?> /><i></i>
									<input type="radio" name="rate_access" value="3" <?php if($rate_access>=3): echo 'checked=checked'; endif; ?> /><i></i>
									<input type="radio" name="rate_access" value="4" <?php if($rate_access>=4): echo 'checked=checked'; endif; ?> /><i></i>
									<input type="radio" name="rate_access" value="5" <?php if($rate_access>=5): echo 'checked=checked'; endif; ?> /><i></i>
								</span>
							</li>
							<li class="col-lg-3">
								<p>運営・設備</p>
								<p class="bg-danger hidden" id="rate_unei_error"></p>
								<span class="star-rating">
								<?php
									$rate_unei = set_value('rate_unei', 0);
								?>
									<input type="radio" name="rate_unei" value="1" <?php if($rate_unei>=1): echo 'checked=checked'; endif; ?> /><i></i>
									<input type="radio" name="rate_unei" value="2" <?php if($rate_unei>=2): echo 'checked=checked'; endif; ?> /><i></i>
									<input type="radio" name="rate_unei" value="3" <?php if($rate_unei>=3): echo 'checked=checked'; endif; ?> /><i></i>
									<input type="radio" name="rate_unei" value="4" <?php if($rate_unei>=4): echo 'checked=checked'; endif; ?> /><i></i>
									<input type="radio" name="rate_unei" value="5" <?php if($rate_unei>=5): echo 'checked=checked'; endif; ?> /><i></i>
								</span>
							</li>
							<li class="col-lg-3">
								<p>清潔感</p>
								<p class="bg-danger hidden" id="rate_clean_error"></p>
								<span class="star-rating">
								<?php
									$rate_clean = set_value('rate_clean', 0);
								?>
									<input type="radio" name="rate_clean" value="1" <?php if($rate_clean>=1): echo 'checked=checked'; endif; ?> /><i></i>
									<input type="radio" name="rate_clean" value="2" <?php if($rate_clean>=2): echo 'checked=checked'; endif; ?> /><i></i>
									<input type="radio" name="rate_clean" value="3" <?php if($rate_clean>=3): echo 'checked=checked'; endif; ?> /><i></i>
									<input type="radio" name="rate_clean" value="4" <?php if($rate_clean>=4): echo 'checked=checked'; endif; ?> /><i></i>
									<input type="radio" name="rate_clean" value="5" <?php if($rate_clean>=5): echo 'checked=checked'; endif; ?> /><i></i>
								</span>
							</li>
							<li class="col-lg-3">
								<p>価格</p>
								<p class="bg-danger hidden" id="rate_price_error"></p>
								<span class="star-rating">
								<?php
									$rate_price = set_value('rate_price', 0);
								?>
									<input type="radio" name="rate_price" value="1" <?php if($rate_price>=1): echo 'checked=checked'; endif; ?> /><i></i>
									<input type="radio" name="rate_price" value="2" <?php if($rate_price>=2): echo 'checked=checked'; endif; ?> /><i></i>
									<input type="radio" name="rate_price" value="3" <?php if($rate_price>=3): echo 'checked=checked'; endif; ?> /><i></i>
									<input type="radio" name="rate_price" value="4" <?php if($rate_price>=4): echo 'checked=checked'; endif; ?> /><i></i>
									<input type="radio" name="rate_price" value="5" <?php if($rate_price>=5): echo 'checked=checked'; endif; ?> /><i></i>
								</span>
							</li>
						</ul>
					</dd>
					</dl>
					<dl class="u-form-input form-group">
						<dt class="must"> 口コミ本文（<span style="color:#FF0000"><strong>＊</strong></span>）</dt>
						<dd>
							<?php echo form_textarea($content);?>
							<?php echo form_error('content');?>
						</dd>
					</dl>
					<?php echo form_submit('regist','投稿する','data-loading-text="処理中…" class="u-btn1 sz1 clr2"');?>　
				</form>
				</div>
			</section>
			<?php echo form_close();?>

			<?php if (isset($news_list) && $news_list): ?>
			<section>
				<h2 class="u-ttl2">関連コラム</h2>
				<div class="news-list">
					<?php foreach($news_list as $news):?>
						<div class="u-card1">
						<?php
							$thumbnail_url = site_url()."img/noimage.png";

							// サムネイル画像をTOPに表示
							if($news["photo_thumbnail"] && file_exists(FCPATH."images/news/".$news["id"]."_thumbnail_450.".$news["photo_thumbnail"]))
							{
								$thumbnail_url = site_url()."images/news/".$news["id"]."_thumbnail_450.".$news["photo_thumbnail"];
							}
							elseif($news["photo1"] && file_exists(FCPATH."images/news/".$news["id"]."_1_450.".$news["photo1"]))
							{
								$thumbnail_url = site_url()."images/news/".$news["id"]."_1_450.".$news["photo1"];
							}
						?>
						<?php $photo_url = base_url("img/noimage.png"); ?>
						<a href="<?php echo site_url('column/'.$news['id']); ?>">
							<div class="sp-title sp"><?php echo $news['headline']; ?></div>
							<div class="img"><img src="<?php echo $thumbnail_url; ?>" alt="<?php echo $news['headline']; ?>"></div>
							<dl class="txt">
								<dt class="ttl pc">
								<?php echo $news['headline']; ?>
								</dt>

							</dl>
						</a>
						</div>
					<?php endforeach?>
				</div>
				<a class="u-btn1 sz1" href="<?php echo base_url('column'); ?>"> 他のコラムを読む</a>
			</section>
			<?php endif;?>

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- 横長タイプ -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-7196163392579632"
     data-ad-slot="3712705419"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
			</div>
		</div>

		<?php if($place["non_affiliated_flag"] != 1){ ?>
		<div class="u-inner" style="padding-top:0">
			<p class="pg-pref-btnTelTxt"><em>無料相談ダイヤル！</em>些細なことでも<em>お気軽に</em>お電話ください！</p>
			<div class="pg-pref-btnTel"><a href="tel:<?=get_tel_number()?>"><img src="<?php echo get_tel_number_big_image(); ?>" alt=""/></a></div>
			<div class="pg-pref-btnPamph"><a href="<?php echo base_url("contact/contact_lp") ?>"><img src="<?php echo base_url("common/img/top/btn_pamph.png") ?>" alt=""/></a></div>
		</div>
		<?php } ?>

	</article>
</div>
<article class="u-bg1">
	<div class="u-inner">
		<div class="container">
			<h2 class="u-ttl1"><span>付近の葬儀場・斎場</span></h2>
			<div class="u-card1">
				<?php
					$flag_more_button = FALSE;
					if (count($place_list) > 10):
						$flag_more_button = TRUE;
						unset($place_list[10]);
					endif;
				?>
				<?php echo $this->load->view('pc/parts/common/place_list', $this->data, TRUE); ?>

			</div>
			<?php if ($flag_more_button): ?>
			<a class="u-btn1 sz1" href="<?php echo site_url($pref_name_e); ?>"> もっと見る</a>
			<?php endif; ?>
		</div>
	</div>
</article>
<?php echo $this->load->view('pc/parts/common/media', $this->data, TRUE); ?>

<?php if($place["non_affiliated_flag"] != 1){ ?>
	<div class="fixbtns">
	    <dl>
	        <dt class="txt1"><img src="<?php echo base_url("common/img/pref/fix_txt1.png") ?>"/>
	        </dt>
	        <dd>
	            <p class="txt2"><a href="tel:<?=get_tel_number()?>"><img src="<?php echo get_tel_number_text_image(); ?>"/></a></p>
	            <p class="txt3"><a href="<?php echo site_url('contact/contact_lp'); ?>"><img src="<?php echo base_url("common/img/top/fix_txt3.png") ?>"/></a></p>
	            <p class="btn_tel_l"><a href="tel:<?=get_tel_number()?>"><img src="<?php echo get_tel_number_big_image(); ?>"/></a></p>
	        </dd>
	    </dl>
	</div>
<?php } ?>

<?php if($place['flag_genre_kasou']):?>
	<?php echo $this->load->view('pc/parts/common/company_kasouba', $this->data, TRUE); ?>
<?php elseif ($place['flag_genre_sogi']): ?>
	<?php echo $this->load->view('pc/parts/common/company_sougi', $this->data, TRUE); ?>
<?php endif; ?>

<script type="text/javascript">
	var place_lat   = "<?php echo $place['lat']; ?>";
	var place_lng = "<?php echo $place['lng']; ?>";

	var default_lat   = 35.681298;
	var default_lng   = 139.766247;

	$(document).ready(function(){
		//GmapLoad();
	});

	// Google Map
	function GmapLoad()
	{
		if (place_lat != '' || place_lng != '')
		{
			latlng = new google.maps.LatLng(place_lat, place_lng);
		}
		else
		{
			latlng = new google.maps.LatLng(default_lat, default_lng);
		}

		var opts = {
			zoom: 15,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			disableDoubleClickZoom: true
		};
		map = new google.maps.Map($('#map_canvas').get(0), opts);

		// マーカー
		marker = new google.maps.Marker({
			position: latlng,
			map: map,
			draggable: false,
		});

		map.addListener('dblclick', function(e){

			var dblatlng = new google.maps.LatLng(e.latLng.lat(), e.latLng.lng());

			map.setCenter(dblatlng);
			marker.setPosition(dblatlng);
		});

	}

$(function() {
  $("dd.qanda").css("display","none");
  $(".faqCont dt").click(function(){
    if($("+dd.qanda",this).css("display")=="none"){
      $("+dd.qanda",this).slideDown("slow");
			$(this).addClass("open");
    }
    else
    if($("+dd.qanda",this).css("display")=="block"){
      $("+dd.qanda",this).slideUp("slow");
			$(this).removeClass("open");
    }
  });
	$(".prefTopMainZone .secPlan .sldBox ul").slick({
    arrows: true,
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 2,
    slidesToScroll: 2,
    variableWidth: false,
    centerMode: false,
    adaptiveHeight: true,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          arrows: true,
          dots: false,
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true
        }
      }
    ]
  });
	$(".showModal1").click(function(){
	    $(".modal1").fadeIn();
	    return false;
	  })

	  $(".close-btn1").click(function () {
	    $(".modal1").fadeOut();

	  })

	$(".showModal2").click(function(){
	    $(".modal2").fadeIn();
	    return false;
	  })

	  $(".close-btn2").click(function () {
	    $(".modal2").fadeOut();

	  });
});
</script>

<style>
.news-list .u-card1 a{
    border: 1px solid #add863;
}

.news-list .u-card1 a .txt .ttl{
	color: #000000;
	border-bottom: unset;
}

.news-list .u-card1 a .sp-title{
	color: #000000;
	border-bottom: unset;
}
.pageDetail .basic-info{
	padding:30px 0 0 0;
}

.pageDetail .plan-detail{
	padding-bottom:30px;
}

.deplanZone .container .u-box1 {
	padding-bottom: 45px;
}
.related-pref .u-box1 {
	line-height: 200%;
	padding-bottom: 0;
    padding-top: 25px;
}
.related-pref .u-box1 > a, .related-pref .u-box1 > span {
	margin-right: 10px;
}
.related-pref .u-box1 > b {
	border-bottom: 3px solid #add863;
}
.related-pref .u-box1 {
	background: #f4f4f4;
	border: 0;
}
.u-inner.related-pref {
	padding-bottom: 0;
}

.fist-t{
  font-size: 2.4rem;
  text-align: center;
  font-weight: bold;
}
</style>
