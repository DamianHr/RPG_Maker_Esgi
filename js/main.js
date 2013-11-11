function XMLWizard() {

    var situations = [];

    XMLWizard.prototype.create_xml_wizard = function (form_id) {
        XMLWizard.prototype.create_xml_wizard_group();
        XMLWizard.prototype.create_xml_wizard_add_button(form_id);
    }

    XMLWizard.prototype.create_xml_wizard_group = function () {
        var title_game;
        var list_container;

        /* Game's Title */
        if ($('.title_game').length == 0) {
            title_game = $('<label />',
                {   id: 'title_game', class: 'title_game', text: 'Titre du jeu : ' }
            ).insertBefore("#finalize-btn");
            var title = $("<input/>",
                {   type: 'text',
                    placeholder: 'Titre du jeu',
                    name: 'title_game'  }
            ).insertAfter('.title_game');
        }

        if ($('.list_container').length == 0) {
            list_container = $('<ul></ul>',
                {   id: 'list_container', class: 'list_container' }
            ).insertBefore("#finalize-btn");
        } else list_container = $('ul.list_container');

        var list_element = $('<li></li>');
        list_container.append(list_element);

        /* Situations ( Actions ) */
        list_element.append($("<label>",
            {   text: 'Action n°' + (situations.length + 1)   }
        ));
        list_element.append($("<br />"));
        list_element.append($("<label />",
            {    text: 'Description :'}
        ));
        var description = $("<input/>",
            {   id: 'desc' + (situations.length + 1),
                type: 'text',
                placeholder: 'Description of the scene',
                name: 'situation'  }
        );
        list_element.append(description);

        list_element.append($("<br />"));

        var questions = [];
        XMLWizard.prototype.create_xml_wizard_add_question_button(('desc' + (situations.length + 1)), questions);

        var situation = new Situation(description, questions);

        situations.push(situation);

        list_element.append($("<a>",
            {   click: function () {
                list_element.remove();
                situations.splice(situations.lastIndexOf(situation), 1);
                //$('#list_element'+totalLength).remove();
            },
                text:'Delete',
                class: 'btn btn-danger'}
        ));

    };

    XMLWizard.prototype.create_xml_wizard_add_button = function (form_id) {
        var form = $("#" + form_id);
        var div = $("<div/>", {   class: 'container' });
        var button = $("<a/>",
            {   click: function () {
                XMLWizard.prototype.create_xml_wizard_group(form_id);
            },
                value: 'Ajouter une nouvelle action',
                text: 'Ajouter une nouvelle action',
                class: 'btn btn-success'}
        );
        div.append(button);
        form.parent().append(div);
    };

    XMLWizard.prototype.create_xml_wizard_add_question_button = function (descriptionId, questions) {
        var div = $("<div/>", {   class: 'button_question' });
        var button = $("<a/>",
            {   click: function () {
                XMLWizard.prototype.create_xml_wizard_add_question(descriptionId, questions);
            },
                value: 'Ajouter une nouvelle question',
                text: 'Ajouter une nouvelle question',
                class: 'btn btn-success'}
        );
        div.append(button);
        div.insertAfter("#" + descriptionId);
    };

    XMLWizard.prototype.create_xml_wizard_add_question = function (descriptionId, questions) {
        var questionNum = questions.length;
        var list_question;
        if ($(".list_question"+descriptionId).length == 0) {
            list_question = $('<ul></ul>',
                {   id: 'list_question' + descriptionId, class: 'list_question' + descriptionId }
            ).insertAfter("#" + descriptionId);
        } else list_question = $('.list_question' + descriptionId);

        var question = $('<li></li>');
        list_question.append(question);

        question.append($("<label>",
            {   text: 'Question n°' + (questionNum + 1)   }
        ));
        var question_id = descriptionId + 'quest' + (questionNum + 1);
        var question_name = descriptionId + 'question' + (questionNum + 1);
        var label_question = $("<input/>",
            {   id: question_id,
                type: 'text',
                placeholder: 'Label of the question',
                name: question_name  }
        );
        question.append(label_question);

        var answers = [];
        XMLWizard.prototype.create_xml_wizard_add_answer_button(question_id, answers);

        /* create 2 answer by default */
        var list_answer = $('<ul></ul>',
            {   id: 'list_answer' + question_id, class: 'list_answer' + question_id }
        ).insertAfter("#" + question_id);
        // add 2 question by default
        XMLWizard.prototype.create_xml_wizard_add_answer(question_id, answers);
        XMLWizard.prototype.create_xml_wizard_add_answer(question_id, answers);

        question.append($("<a>",
            {   click: function () {
                question.remove();
                questions.splice(questions.lastIndexOf(question), 1);
                //$('#list_element'+totalLength).remove();
            },
                text:'Delete question',
                class: 'btn btn-danger'}
        ));

        questions.push(new Question(label_question, answers));
    };

    XMLWizard.prototype.create_xml_wizard_add_answer_button = function (questionId, answers) {
        var div = $("<div/>", {   class: 'button_answer' });
        var button = $("<a/>",
            {   click: function () {
                XMLWizard.prototype.create_xml_wizard_add_answer(questionId, answers);
            },
                value: 'Ajouter une nouvelle réponse',
                text: 'Ajouter une nouvelle réponse',
                class: 'btn btn-success'}
        );
        div.append(button);
        div.insertAfter("#" + questionId);
    };


    XMLWizard.prototype.create_xml_wizard_add_answer = function (questionId, answers) {
        var answerNum = answers.length;
        var list_answer;
        list_answer = $('.list_answer' + questionId);

        var answer = $('<li></li>');
        list_answer.append(answer);

        var answer_id = questionId + 'answ' + (answerNum + 1);
        var answer_name = questionId + 'answer' + (answerNum + 1);

        // answer label
        answer.append($("<label>",
            {   text: 'Réponse n°' + (answerNum + 1)   }
        ));
        var label_answer = $("<input/>",
            {   id: answer_id,
                type: 'text',
                placeholder: 'Label of the answer',
                name: answer_name  }
        );
        answer.append(label_answer);

        // answer's points
        answer.append($("<label>",
            { text: 'Nombre de points' }
        ));
        var point_answer = $("<input/>",
            {
                type: 'number',
                placeholder: 'point of the answer',
                name: 'answerPoint' + answerNum  }
        );
        answer.append(point_answer);

        // relation goTo situation
        // answer's points
        answer.append($("<label>",
            { text: 'Numéro de la prochaine situation' }
        ));
        var code_goto_answer = $("<input/>",
            {
                type: 'number',
                placeholder: 'goTo of the answer',
                name: 'answerGoTo' + answerNum  }
        );
        answer.append(code_goto_answer);

        answers.push(new Answer(label_answer, point_answer, code_goto_answer));
    };

    function Answer(label, point_answer, code_goto_answer) {
        this.label = label;
        this.point_answer = point_answer;
        this.code_goto_answer = code_goto_answer;
    }

    function Question(label, answers) {
        this.label = label;
        this.answers = answers;
    }
}

/*refait florim*/
function Situation(description, questions) {
    this.description = description;
    this.questions = questions;
}

//function Situation(description, question) {
//    this.description = description;
//    this.question = question;
//}