function XMLWizard() {

    var situations = [];
    var listContainer;
    var gameTitle;

    XMLWizard.prototype.setOnclickFinalize = function () {
        $('#finalize-btn').click(function() {
            XMLWizard.prototype.finalyze();
        }
    )};

    XMLWizard.prototype.create_xml_wizard = function (form_id) {
        XMLWizard.prototype.createMainElements();
        XMLWizard.prototype.createSituationGroup();
        XMLWizard.prototype.createSituationButton(form_id);
        XMLWizard.prototype.setOnclickFinalize();
    };

    XMLWizard.prototype.createMainElements = function () {

        /* Game's Title */
        $('<label />',
            {   id: 'title_game', class: 'title_game', text: 'Name of the game :  ' }
        ).insertBefore("#finalize-btn");

        gameTitle = $("<input/>",
            {   type: 'text',
                class:'title_game_input form-control',
                placeholder: 'Your game\'s title',
                name: 'title_game'  }
        ).insertAfter('.title_game');

        if ($('.list_container').length == 0) {
            listContainer = $('<ul></ul>',
                {   id: 'list_container', class: 'list_container' }
            ).insertBefore("#finalize-btn");
        } else listContainer = $('ul.list_container');

        return listContainer;
    };

    XMLWizard.prototype.createSituationGroup = function () {
        var id = situations.length + 1;
        var listElement = $('<li></li>', {
            id: 'desc_' + id
        });
        listContainer.append(listElement);

        listElement.append($("<img>",
            {   click: function () {
                if(situations.length > 1) {
                    listElement.remove();
                    situations.splice(situations.lastIndexOf(situations), 1);
                }
            },
                src:"../img/trash.png",
                class:'trash_icon'}
        ));

        listElement.append($("<label>",
            {   text: 'Action n°' + id   }
        ));

        listElement.append($("<br />"));
        listElement.append($("<label />",
            {    text: 'Description :'}
        ));
        var description = $("<input/>",
            {   class:'description_input form-control',
                type: 'text',
                placeholder: 'Description of the scene'
            }
        );
        listElement.append(description);
        listElement.append($("<br />"));

        var formSituation = new FormSituation(id, description, null);
        XMLWizard.prototype.createQuestionButton(listElement, formSituation);

        situations.push(formSituation);
    };

    XMLWizard.prototype.createSituationButton = function (form_id) {
        var form = $("#" + form_id);
        var div = $("<div/>", {   class: 'container' });
        var button = $("<a/>",
            {   click: function () {
                XMLWizard.prototype.createSituationGroup();
            },
                id: 'add_situation_btn',
                value: 'Add a situation',
                text: 'Add a situation',
                class: 'btn btn-success'}
        );
        div.append(button);
        form.parent().append(div);
    };

    XMLWizard.prototype.createQuestionButton = function (situation, formSituation) {
        var div = $("<div/>", {  class:'bnt_question' });
        var button = $("<a/>",
            {   click: function () {
                formSituation.question = XMLWizard.prototype.createQuestionSection(situation, this);
                this.parentElement.style.display = "none";
            },
                value: 'Add a question',
                text: 'Add a question',
                class: 'btn btn-success' }
        );
        div.append(button);
        situation.append(div);
        return div;
    };

    XMLWizard.prototype.createQuestionSection = function (situation, button) {
        var questionElement = $('<div>',
            {   class: 'div_question' }
        );
        situation.append(questionElement);
        questionElement.append($("<img>",
            {   click: function () {
                questionElement.remove();
                button.parentElement.style.display = "block";
                situation.question = null;
            },
                src:"../img/trash.png",
                class:'trash_icon' }
        ));
        questionElement.append($("<label>",
            {   text: 'Question'   }
        ));

        var labelQuestion = $("<input/>",
            {   class:'question_input form-control',
                type: 'text',
                placeholder: 'Label of the question'  }
        );
        questionElement.append(labelQuestion);
        questionElement.append($('<ul></ul>',
            {   class: 'list_answer' }
        ));
        var answers = [];
        var question = new FormQuestion(labelQuestion, answers);
        situation.question = question;
        // add 2 question by default
        answers.push(XMLWizard.prototype.createAnswerSection(situation));
        situation.question.setAnswers(answers);
        answers.push(XMLWizard.prototype.createAnswerSection(situation));
        situation.question.setAnswers(answers);

        questionElement.append(XMLWizard.prototype.createAnswerButton(situation));
        return question;
    };

    XMLWizard.prototype.createAnswerButton = function (situation) {
        var div = $("<div/>", {   class: 'button_answer' });
        var button = $("<a/>",
            {   click: function () {
                situation.question.answers.push(XMLWizard.prototype.createAnswerSection(situation));
            },
                value: 'Add a answer',
                text: 'Add a answer',
                class: 'btn btn-success' }
        );
        div.append(button);
        return div;
    };

    XMLWizard.prototype.createAnswerSection = function (situation) {
        var id = parseInt(situation.question.getLastAnswerId())+1;
        var listElement = $('#'+situation[0].id+' .list_answer');
        var answerElement = $('<li></li>');
        listElement.append(answerElement);
        answerElement.append($("<img>",
            {   click: function () {
                if(listElement[0].childNodes.length > 2) {
                    answerElement.remove();
                    var index = situation.question.getLastAnswerId();
                    if(index > 0) situation.question.answers.splice(index, 1);
                }
            },
                src:"../img/trash.png",
                class:'trash_icon'}
        ));

        // answer label
        answerElement.append($("<label>",
            {  text: 'Answer'   }
        ));

        var labelanswer = $("<input/>",
            {   class:'answer_input form-control',
                type: 'text',
                placeholder: 'Label of the answer'  }
        );
        answerElement.append(labelanswer);

        // answer's points
        answerElement.append($("<label>",
            {   text: 'Points amount',
                class:'points_label' }
        ));
        var pointAnswer = $("<input/>",
            {   class:'points_input up_down_input',
                type: 'number',
                min: 1,
                value: 1   }
        );
        answerElement.append(pointAnswer);

        // relation goTo situation
        answerElement.append($("<label>",
            {   text: 'Number of the next action',
                class:'number_next_label'   }
        ));
        var codeGotoAnswer = $("<input/>",
            {   class:'number_next_input up_down_input',
                type: 'number',
                min: 0,
                value: 0   }
        );
        answerElement.append(codeGotoAnswer);
        return new FormAnswer(id,  labelanswer, pointAnswer, codeGotoAnswer);
    };

    function FormSituation(id, description, question) {
        this.id = id; this.description = description;  this.question = question;
    }

    function FormAnswer(id, label, pointAnswer, codeGotoAnswer) {
        this.id = id; this.label = label; this.point_answer = pointAnswer; this.code_goto_answer = codeGotoAnswer;
    }

    function FormQuestion(label, answers) {
        this.label = label; this.answers = answers;
        FormQuestion.prototype.getLastAnswerId = function() {
            var i = 0; for(var a in answers) {  if(i < answers[a]) { i = answers[a];   } }
            return i;
        };
        FormQuestion.prototype.getAnswerIndexById = function(id) {
            for(var i = 0; i <answers.length;i++) {  if(id < answers[i].id) {  return i; } }
            return -1;
        };
        FormQuestion.prototype.setAnswers = function(a) {  answers = a; };
    }

    XMLWizard.prototype.finalyze = function () {
        var game = new Game(gameTitle[0].value);
        for(var s in situations) {
            s = situations[s];
            var situation = new Situation(s.id, s.description[0].value);
            game.addSituation(situation);
            if(s.question==null) continue;
            var question = new Question(s.question.label[0].value);
            situation.setQuestion(question);

            for(var a in s.question.answers) {
                a = s.question.answers[a];
                var answer = new Answer(a.point_answer[0].value, a.code_goto_answer[0].value, a.label[0].value );
                question.addAnswer(answer);
            }
        }
        var input = $('#xml_input');
        input[0].value = XMLPooper(game);

        var form  = $('#xml_wizard');
        form[0].submit();
    }
}