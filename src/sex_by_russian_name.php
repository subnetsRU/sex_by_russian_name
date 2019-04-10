class SexByRussianName {
    /*
	sex_by_russian_name original JS version (c) Vadim Galkin (aka Vadimiztveri)
	Source:  https://github.com/vadimiztveri/sex_by_russian_name
	Demo: http://vadimiztveri.github.io/

	SexByRussianName PHP class (c) Nikolaev Dmitry (aka virus)
	Source: https://github.com/subnetsRU/sex_by_russian_name
    */

    public $surname = false;
    public $name = false;
    public $middlename = false;

    private $unknown = 0;
    private $male = 1;
    private $female = 2;

    private $SURNAME = 0;
    private $MIDDLENAME = 1;
    private $FIRST_NAME = 2;

    private $surname_completions = array(
	array(),
	array('ов', 'ев' ,'ин' ,'ын', 'ой', 'цкий', 'ский', 'цкой', 'ской'),
	array('ова', 'ева', 'ина', 'ая', 'яя', 'екая', 'цкая'),
    );
    private $middlename_completions = array(
	array(),
	array('ович', 'евич', 'ич'),
	array('овна', 'евна', 'ична'),
    );
    private $popular_names = array(
	array(),
	array('абрам', 'аверьян', 'авраам', 'агафон', 'адам', 'азар', 'акакий', 'аким', 'аксён', 'александр', 'алексей', 'альберт', 'анатолий', 'андрей', 'андрон', 'антип', 'антон', 'аполлон', 'аристарх', 'аркадий', 'арнольд', 'арсений', 'арсентий', 'артем', 'артём', 'артемий', 'артур', 'аскольд', 'афанасий', 'богдан', 'борис', 'борислав', 'бронислав', 'вадим', 'валентин', 'валерий', 'варлам', 'василий', 'венедикт', 'вениамин', 'веньямин', 'венцеслав', 'виктор', 'вилен', 'виталий', 'владилен', 'владимир', 'владислав', 'владлен', 'всеволод', 'всеслав', 'вячеслав', 'гавриил', 'геннадий', 'георгий', 'герман', 'глеб', 'григорий', 'давид', 'даниил', 'данил', 'данила', 'демьян', 'денис', 'димитрий', 'дмитрий', 'добрыня', 'евгений', 'евдоким', 'евсей', 'егор', 'емельян', 'еремей', 'ермолай', 'ерофей', 'ефим', 'захар', 'иван', 'игнат', 'игорь', 'илларион', 'иларион', 'илья', 'иосиф', 'казимир', 'касьян', 'кирилл', 'кондрат', 'константин', 'кузьма', 'лавр', 'лаврентий', 'лазарь', 'ларион', 'лев', 'леонард', 'леонид', 'лука', 'максим', 'марат', 'мартын', 'матвей', 'мефодий', 'мирон', 'михаил', 'моисей', 'назар', 'никита', 'николай', 'олег', 'осип', 'остап', 'павел', 'панкрат', 'пантелей', 'парамон', 'пётр', 'петр', 'платон', 'потап', 'прохор', 'роберт', 'ростислав', 'савва', 'савелий', 'семён', 'семен', 'сергей', 'сидор', 'спартак', 'тарас', 'терентий', 'тимофей', 'тимур', 'тихон', 'ульян', 'фёдор', 'федор', 'федот', 'феликс', 'фирс', 'фома', 'харитон', 'харлам', 'эдуард', 'эммануил', 'эраст', 'юлиан', 'юлий', 'юрий', 'яков', 'ян', 'ярослав'),
	array('авдотья', 'аврора', 'агата', 'агния', 'агриппина', 'ада', 'аксинья', 'алевтина', 'александра', 'алёна', 'алена', 'алина', 'алиса', 'алла', 'альбина', 'амалия', 'анастасия', 'ангелина', 'анжела', 'анжелика', 'анна', 'антонина', 'анфиса', 'арина', 'белла', 'божена', 'валентина', 'валерия', 'ванда', 'варвара', 'василина', 'василиса', 'вера', 'вероника', 'виктория', 'виола', 'виолетта', 'вита', 'виталия', 'владислава', 'власта', 'галина', 'глафира', 'дарья', 'диана', 'дина', 'ева', 'евгения', 'евдокия', 'евлампия', 'екатерина', 'елена', 'елизавета', 'ефросиния', 'ефросинья', 'жанна', 'зиновия', 'злата', 'зоя', 'ивонна', 'изольда', 'илона', 'инга', 'инесса', 'инна', 'ирина', 'ия', 'капитолина', 'карина', 'каролина', 'кира', 'клавдия', 'клара', 'клеопатра', 'кристина', 'ксения', 'лада', 'лариса', 'лиана', 'лидия', 'лилия', 'лина', 'лия', 'лора', 'любава', 'любовь', 'людмила', 'майя', 'маргарита', 'марианна', 'мариетта', 'марина', 'мария', 'марья', 'марта', 'марфа', 'марьяна', 'матрёна', 'матрена', 'матрона', 'милена', 'милослава', 'мирослава', 'муза', 'надежда', 'настасия', 'настасья', 'наталия', 'наталья', 'нелли', 'ника', 'нина', 'нинель', 'нонна', 'оксана', 'олимпиада', 'ольга', 'пелагея', 'полина', 'прасковья', 'раиса', 'рената', 'римма', 'роза', 'роксана', 'руфь', 'сарра', 'светлана', 'серафима', 'снежана', 'софья', 'софия', 'стелла', 'степанида', 'стефания', 'таисия', 'таисья', 'тамара', 'татьяна', 'ульяна', 'устиния', 'устинья', 'фаина', 'фёкла', 'фекла', 'феодора', 'хаврония', 'христина', 'эвелина', 'эдита', 'элеонора', 'элла', 'эльвира', 'эмилия', 'эмма', 'юдифь', 'юлиана', 'юлия', 'ядвига', 'яна', 'ярослава'),
    );
    private $names_endings = array(
	array(),
	array('ан','ий','ин','ат','он','ар','ер','ир','ик','ай','ис','ен','ей','им','ас','ек','ил','ав','ак','ад'),
	array('на','ия','та','да','ла','ка','ма','са','ва','за'),
    );

    function __construct($surname = false, $name = false, $middlename = false){
	$this->surname = $surname ? $surname : false;
	$this->name = $name ? $name : false;
	$this->middlename = $middlename ? $middlename : false;
    }

  /**
   * @return {Number} 0 - не определен; 1 - мужской; 2 - женский;
   */
    public function get_gender(){
	$surname = false;
	$name = false;
	$middlename = false;
	if ($this->surname){
	    $surname = $this->gender_by($this->SURNAME, $this->surname);
	}
	if ($this->name){
	    $name = $this->gender_by_first_name();
	}
	if ($this->middlename){
	    $middlename = $this->gender_by($this->MIDDLENAME, $this->middlename);
	}
	$gender = $this->determine_gender(array($surname,$name,$middlename));
     return $gender;
    }

  /**
   * @private
   */
    private function determine_gender($genders = array()){
	$gender = $this->unknown;
	$male = false;
	$female = false;

	for ($i=0; $i < 3; $i++){
	    if ($genders[$i] === $this->male){
		$male = true;
	    }
	    if ($genders[$i] === $this->female){
		$female = true;
	    }
	}
	if ($male && !$female){
	    $gender = $this->male;
	}
	if (!$male && $female){
	    $gender = $this->female;
	}
     return $gender;
    }

  /**
   * @private
   */
    private function gender_by_first_name(){
	$gender = $this->unknown;
	$first_name = $this->normalize($this->name);
	if ($this->is_popular_name($first_name, $this->female)){
	    $gender = $this->female;
	}
	if ($gender == $this->unknown){
	    if ($this->is_popular_name($first_name, $this->male)){
		$gender = $this->male;
	    }
	}
	if ($gender == $this->unknown){
	    if (in_array(mb_substr( $first_name , -2),$this->names_endings[$this->female])){
		$gender = $this->female;
	    }
	}
	if ($gender == $this->unknown){
	    if (in_array(mb_substr( $first_name , -2),$this->names_endings[$this->male])){
		$gender = $this->male;
	    }
	}
     return $gender;
    }

  /**
   * @private
   */
    private function gender_by($name_type,$string){
	$ret = $this->unknown;
	$name = $this->normalize($string);
	if ($this->is_correct($name, $name_type, $this->female)){
	    $ret = $this->female;
	}
	if ($this->is_correct($name, $name_type, $this->male)){
	    $ret = $this->male;
	}
     return $ret;
    }

  /**
   * Возвращает true или false, если окончание соответствует формальным правилам
   * @param {String} string (Например: "Иванова")
   * @param {Number} type, или окончание фамилии (1), или окончание отчества (0) (Например: 1)
   * @param {Number} gender, или мужской род (1), или женский род (0) (Например: 0)
   * @return {Boolean} (Например: true)
   * @private
   */
    private function is_correct($string, $type, $gender){
	$is_correct = false;
	$completions = array();
	switch ($type){
	    case $this->SURNAME:
		$completions = $this->surname_completions[$gender];
		break;
	    case $this->MIDDLENAME:
		$completions = $this->middlename_completions[$gender];
	}
	for ($i=0; $i < count($completions); $i++){
	    $completion = $this->completion($string, mb_strlen($completions[$i]));
	    if ($completion === $completions[$i]){
		$is_correct = true;
	    }
	}
    return $is_correct;
  }

  /**
   * @return {Boolean}
   * @private
   */
    private function is_popular_name($first_name, $gender) {
	$is_popular_name = false;
	$names = $this->popular_names[$gender];
	for ($i=0; $i<count($names);$i++){
	    if ($first_name === $names[$i]){
		$is_popular_name = true;
	    }
	}
     return $is_popular_name;
    }

  /**
   * Возвращает окончание слова
   * @param {String} string (Например: "Иванова")
   * @param {Number} count (Например: 4)
   * @return {String} (Например: "нова")
   * @private
   */
    private function completion($string, $count){
	$len = mb_strlen($string);
	$completion = mb_substr($string,($len - $count), ($len - 1));
     return $completion;
    }

  /**
   * @private
   */
    private function normalize($string){
	$normal_string = mb_strtolower($string);
	$normal_string = preg_replace("/\s+/",'',$normal_string);
     return $normal_string;
    }
}
