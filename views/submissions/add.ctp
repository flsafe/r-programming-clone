<div id="submitsolution">
	
	<h1>Submit Your Code</h1>
	<?php
		$syntax = array('c'          => 'C',
										'clojure'    => 'Clojure',
										'cpp'        =>'C++',
										 'csharp'    =>'C#',
										 'D'         =>'D',
										'erlang'     =>'Erlang',
										'fsharp'     =>'F#',
										'haskell'    =>'Haskell',
										'java5'      =>'Java',
										'javascript' =>'JavaScript',
										'lisp'       =>'Lisp',
										'lua'        =>'Lua',
										'perl6'      =>'Perl',
										'python'     =>'Python',
										'ruby'       =>'Ruby');
	
		echo $form->create('Submission', array('controller'=>'submissions', 'action'=>'add'));
		echo $form->input('Submission.title');
		echo $form->input('Submission.description1', array('label'=>'File Description'));
	?>

	<div class="input">
		<?php	
			echo $form->label('Submission.text1', "Paste Your Code Here");
			echo $form->textArea('Submission.text1', array('rows'=>'22'));
			echo $form->error('Submission.text1');
		?>
	</div>
	
	<div class="input">
		<?php 
			echo $form->label('Submission.syntax', "Syntax Highlighting");
			echo $form->select('Submission.syntax', $syntax, 'c', null, false); 
		?>
	</div>
	
	<div>
		<img src="<?php echo $html->url(array('controller'=>'submissions', 'action'=>'captcha'));?>"/>
	</div>

	<?php	
		echo $form->input('Submission.captcha', array('label'=>"Are you a robot?"));
		echo $form->end('Submit'); 
	?>
	
</div>
