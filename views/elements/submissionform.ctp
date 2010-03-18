<?php
	#params
	#id - (optional) set the id hidden when the action is edit
	#action - add, edit
?>
<div id="submissionform">
	
<?php
		$syntax = array('c'          => 'C', #TODO: These need to go into the DB
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
		
		echo $form->label('Submission.title', 'Title');
		echo $form->input('Submission.title', array('label'=>false));
		
		echo $form->label('Submisson.description1', 'Description');
		echo $html->link('(format help)', array('controller'=>'pages', 'action'=>'display', 'format_help'), array('id'=>'formformathelp'));
		echo $form->input('Submission.description1', array('label'=>false));
		
		echo $form->label('Submission.text1', "Paste Your Code Here") . "<br/>";
		echo $form->textArea('Submission.text1', array('rows'=>'22', 'label'=>false)) . "<br/>"; #TODO: Temp hack. Get the CSS to do this for you
		echo $form->error('Submission.text1');
		
		echo $form->label('Submission.syntax', "Syntax Highlighting", array('div'=>'input')). "&nbsp;";
		if($action == "add")
			echo $form->select('Submission.syntax', $syntax, 'c', false) . '<br/><br/>'; 
		else
			echo $form->select('Submission.syntax', $syntax) . '</br><br/>';
			
		if($action == 'add')
	 		echo $this->element('captcha', array('modelname'=>'Submission', 'formhelper'=>$form));
	
		echo $form->end('Submit');
?>
</div>
