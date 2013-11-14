function XMLWizard() {

    var situations = [];

    XMLWizard.prototype.create_xml_wizard = function (form_id) {
        XMLWizard.prototype.create_xml_wizard_group();
        XMLWizard.prototype.create_xml_wizard_add_button(form_id);
    };

    XMLWizard.prototype.create_xml_wizard_group = function () {
        var title_game;
        var list_container;

        /* Game's Title */
        if ($('.title_game').length == 0) {
            title_game = $('<label />',
                {   id: 'title_game', class: 'title_game', text: 'Name of the game :  ' }
            ).insertBefore("#finalize-btn");
            $("<input/>",
                {   type: 'text',
                    class:'title_game_input',
                    placeholder: 'Your game\'s title',
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

        var label_description_id = 'labeldesc_' + (situations.length + 1);
        var description_id = 'desc_' + (situations.length + 1);

        /* Situations ( Actions ) */
        list_element.append($("<label>",
            {   id: label_description_id,
                text: 'Action n°' + (situations.length + 1)   }
        ));

        // TODO faire la même chose en changeant cette fois le numéro des situation, question et réponses contenant le numéro de cette situation
        list_element.append($("<img>",
            {   click: function () {
                list_element.remove();
                situations.splice(situations.lastIndexOf(situation), 1);
                //$('#list_element'+totalLength).remove();
            },
                width:'25px',
                height:'25px',
                src:"../img/trash.png",
                class:'trash_icon'}
        ));

        list_element.append($("<br />"));
        list_element.append($("<label />",
            {    text: 'Description :'}
        ));
        var description = $("<input/>",
            {   id: description_id,
                class:'description_input',
                type: 'text',
                placeholder: 'Description of the scene',
                name: description_id
            }
        );
        list_element.append(description);

        list_element.append($("<br />"));

        var questions = [];
        XMLWizard.prototype.create_xml_wizard_add_question_button(description_id, questions);

        var situation = new Situation(description, questions);

        situations.push(situation);
    };

    XMLWizard.prototype.create_xml_wizard_add_button = function (form_id) {
        var form = $("#" + form_id);
        var div = $("<div/>", {   class: 'container' });
        var button = $("<a/>",
            {   click: function () {
                XMLWizard.prototype.create_xml_wizard_group();
            },
                id: 'add_action_btn',
                value: 'Add a action',
                text: 'Add a action',
                class: 'btn btn-success'}
        );
        div.append(button);
        form.parent().append(div);
    };

    XMLWizard.prototype.create_xml_wizard_add_question_button = function (descriptionId, questions) {
        var div = $("<div/>", {   id: 'button_question' + descriptionId, class:'bnt_question'});
        var button = $("<a/>",
            {   click: function () {
                XMLWizard.prototype.create_xml_wizard_add_question(descriptionId, questions);
            },
                value: 'Add a question',
                text: 'Add a question',
                class: 'btn btn-success'}
        );
        div.append(button);
        div.insertAfter("#" + descriptionId);
    };

    XMLWizard.prototype.create_xml_wizard_add_question = function (descriptionId, questions) {
        var questionNum = questions.length;
        if (questionNum == 0) {
            var list_question;
            if ($('.list_question' + descriptionId).length == 0) {
                list_question = $('<ul></ul>',
                    {   id: 'list_question' + descriptionId, class: 'list_question' }
                ).insertAfter("#" + descriptionId);
            } else list_question = $('.list_question' + descriptionId);

            var question = $('<li></li>');
            list_question.append(question);

            var label_question_id = descriptionId + '_labelquest_' + (questionNum + 1);
            var question_id = descriptionId + '_quest_' + (questionNum + 1);

            question.append($("<label>",
                {   id: label_question_id,
                    text: 'Question n°' + (questionNum + 1)   }
            ));

            question.append($("<img>",
                    {   click: function () {
                        question.remove();
                        questions.splice(questions.lastIndexOf(question), 1);
                        $('.list_question' + descriptionId).remove();
                        if (questions.length == 0) {
                            XMLWizard.prototype.create_xml_wizard_add_question_button(descriptionId, questions);
                        }
                        this.remove();
                        //$('#list_element'+totalLength).remove();
                    },
                    width:'25px',
                    height:'25px',
                    src:"../img/trash.png",
                    class:'trash_icon'}
            ));

            var label_question = $("<input/>",
                {   id: question_id,
                    class:'question_input',
                    type: 'text',
                    placeholder: 'Label of the question',
                    name: question_id  }
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

            $('.button_question' + descriptionId).remove();

            questions.push(new Question(label_question, answers));
        }
    };

    XMLWizard.prototype.create_xml_wizard_add_answer_button = function (questionId, answers) {
        var div = $("<div/>", {   class: 'button_answer' });
        var button = $("<a/>",
            {   click: function () {
                XMLWizard.prototype.create_xml_wizard_add_answer(questionId, answers);
                if (answers.length < 2) {
                    XMLWizard.prototype.create_xml_wizard_add_answer(questionId, answers);
                }
            },
                value: 'Add a answer',
                text: 'Add a answer',
                class: 'btn btn-success'}
        );
        div.append(button);
        div.insertAfter("#" + questionId);
    };


    XMLWizard.prototype.create_xml_wizard_add_answer = function (questionId, answers) {
        var answerNum = answers.length;
        var list_answer;
        list_answer = $('.list_answer' + questionId);
        var li_answer_id = questionId + '_liansw_' + (answerNum + 1);
        var answer = $('<li></li>',
            { id: li_answer_id});
        list_answer.append(answer);

        var label_answer_id = questionId + '_labelansw_' + (answerNum + 1);
        var answer_id = questionId + '_answ_' + (answerNum + 1);
        var answer_point_id = questionId + '_answpoint_' + (answerNum + 1);
        var answer_goto_id = questionId + '_answgoto_' + (answerNum + 1);

        // answer label
        answer.append($("<label>",
            { id: label_answer_id,
                text: 'Answer #' + (answerNum + 1)   }
        ));

        answer.append($("<img>",
            {   id: questionId + '_buttondelanswer_' + (answerNum+1),
                click: function () {
                    var splitted_id = this.id.split('_');
                    var answerToDelIndex = splitted_id[splitted_id.length-1];
                    $('#' + (questionId + '_liansw_' + (answerToDelIndex))).remove();
                    //TODO supprimer dans le tableau answers le answer à l'index answerToDel je crois car problème lors de l'ajout sur index;

                    answers.splice(answerToDelIndex, 1);
                    for (var i = (answerToDelIndex+1); i <= answers.length; i++) {
                        // TODO petit problème avec les id quand rajoute
                        alert('to modify => #' + (questionId + '_liansw_' + (1 + i)));
                        alert('by => ' + (questionId + '_liansw_' + (i)));
                        // récup le <li> qui contient la réponse suivant celle qu'on supprime et lui remet un id-1
                        $('#' + (questionId + '_liansw_' + (1 + i))).attr('id', (questionId + '_liansw_' + (i)));
                        // récupère le bouton supprimer et lui change son id sinon, ça supprime le mauvais li avec un décalage
                        $('#' + (questionId + '_buttondelanswer_' + (1+i))).attr('id', (questionId + '_buttondelanswer_' + (i)));
                        // TODO récupérer les endroits où y a un id pour les réponses et les décaler de - 1 ( labelid, id, gotoid etc. )

                        // TODO gérer le cas où il ne reste que 2 réponses => Message disant que ça va supprimer la question + les 2 réponses
                    }
                    this.remove();
                },
                width:'25px',
                height:'25px',
                src:"../img/trash.png",
                class:'trash_icon'}
        ));

        var label_answer = $("<input/>",
            {   id: answer_id,
                class:'answer_input',
                type: 'text',
                placeholder: 'Label of the answer',
                name: answer_id  }
        );
        answer.append(label_answer);

        // answer's points
        answer.append($("<label>",
            {
                text: 'Points amount',
                class:'points_label'
            }
        ));
        var point_answer = $("<input/>",
            {   id: answer_point_id,
                class:'points_input',
                type: 'number',
                name: answer_point_id  }
        );
        answer.append(point_answer);

        // relation goTo situation
        answer.append($("<label>",
            {
                text: 'Number of the next situation',
                class:'number_next_label'
            }
        ));
        var code_goto_answer = $("<input/>",
            {   id: answer_goto_id,
                class:'number_next_input',
                type: 'number',
                name: answer_goto_id  }
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