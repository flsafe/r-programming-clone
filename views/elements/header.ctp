<div id="header">
		<span id="menu">
			<?php 
				$space = "&nbsp;&nbsp;&nbsp;";

				$sessionUser = $session->read('Auth.User');
				if(!empty($sessionUser)){
					
					$sessionUsername = $sessionUser['username'];
					echo $html->link("$sessionUsername", 
													 array('controller' =>'users',
													       'action'     =>'edit')) . $space ;
													
					echo $html->link('Logout', 
												   array('controller'=>'users', 
																 'action'    =>'logout')) . $space;
																
					echo "<input id=\"loggedin\" name=\"{$sessionUsername}\" type=\"hidden\"/>";
				}
				else{
					echo $html->link('Login', array('controller'=>'users', 'action'=>'login')) . $space;
					echo $html->link('Register', array('controller'=>'users', 'action'=>'add')) . $space;
				}
			?>
		</span>

		<?php echo $html->link($html->image('codekettllogo.png', array('alt'        =>'logo', 
																																	 'id'         =>'logo')), 
																																	
																														 array('controller' =>'topics', 
																																  'action'      =>'index'),
																																
		                                                         array('alt'        =>'codekettl logo'), false, false); 
		?>
		
		<div id="tagline">
			<?php echo $html->link('Your Daily Cup Of Programming Interview Practice', array('controller'=>'topics')); ?>
		</div>
</div>