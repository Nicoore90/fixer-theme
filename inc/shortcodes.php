<?php 

	add_shortcode('home_form', function() {
		?>
			<form action="https://repuestosfixer.com/shop/">
										<select data-name="filter_make">
							<option value="">Select make</option>
														<option value="make-bmw">BMW</option>					
															<option value="make-ford">Ford</option>					
															<option value="make-hyundai">Hyundai</option>					
															<option value="make-lexus">Lexus</option>					
															<option value="make-mazda">Mazda</option>					
															<option value="make-mercerdess">Mercerdess</option>					
															<option value="make-toyota">Toyota</option>					
													</select>
												<select data-name="filter_model">
							<option value="">Select model</option>
														<option value="124-gt">124 GT</option>					
															<option value="124-spider">124 SPIDER</option>					
															<option value="500">500</option>					
															<option value="500c">500C</option>					
															<option value="595">595</option>					
															<option value="595c">595C</option>					
													</select>
												<select data-name="filter_years">
							<option value="">Select years</option>
														<option value="2019">2019</option>					
															<option value="2020">2020</option>					
															<option value="2021">2021</option>					
															<option value="2022">2022</option>					
													</select>
												<select data-name="filter_engine">
							<option value="">Select engine</option>
														<option value="1-1">1.1</option>					
															<option value="1-2">1.2</option>					
															<option value="1-3">1.3</option>					
															<option value="1-4">1.4</option>					
													</select>
										<input type="submit" value="Go">
			</form>
		<?php
	})
?>