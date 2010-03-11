<?php
	#params
	#id - (optional) set the id hidden when the action is edit
	#action - add, edit
?>
<div id="submissionform">
	<?php
		$syntax = array('c'          => 'C',
										'clojure'    => 'Clojure',
										'cpp'        =>'C++',
										 'csharp'    =>'C#',
										 'd'         =>'D',
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
	
		echo $form->create('Submission', array('controller'=>'submissions'));
		echo $form->input('Submission.id', array('type'=>'hidden'));
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
			if($action == "add")
				echo $form->select('Submission.syntax', $syntax, 'c', null, false); 
			else
				echo $form->select('Submission.syntax', $syntax);
		?>
	</div>
	
	<?php
		if($action == 'add')
	 		echo $this->element('captcha', array('modelname'=>'Submission', 'formhelper'=>$form));
		echo $form->end('Submit'); 
	?>
	
</div>
