/**
 *  Below game class
 */
function Game(title) {
    this.title = title;
    this.situations = [];
}

Game.prototype.addSituation = function (situation) {
    this.situations.push(situation);
};

Game.prototype.removeSituationByRef = function (situation) {
    for (var i = 0; i < this.situations.length; ++i) {
        if (situation === this.situations[i]) {
            this.situations.splice(i, 1);
            return;
        }
    }
};

/**
 *  Below situation class
 */

function Situation(code, text) {
    this.code = code;
    this.text = text;

    this.questions = [];
}

Situation.prototype.addQuestion = function (question) {
    this.questions.push(question);
};

Situation.prototype.removeQuestionByRef = function (question) {
    for (var i = 0; i < this.questions.length; ++i) {
        if (question === this.questions[i]) {
            this.questions.splice(i, 1);
            return;
        }
    }
};


/**
 *  Below Question class
 */


function Question(label) {
    this.label = label;
    this.answers = [];
}

Question.prototype.addAnswer = function (answer) {
    this.answers.push(answer);
};

Question.prototype.removeAnswerByRef = function (answer) {
    for (var i = 0; i < this.answers.length; ++i) {
        if (answer === this.questions[i]) {
            this.answers.splice(i, 1);
            return;
        }
    }
}
;


/**
 *  Below answer class
 */

function Answer(code, value, goto, text) {
    this.code = code;
    this.value = value;
    this.goto = goto;
    this.text = text;
}