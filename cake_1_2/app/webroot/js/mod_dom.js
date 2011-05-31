// ===== namespace =====
if( ! window.info ) { info = {}; }
if( ! info.vividcode ) { info.vividcode = {}; }
if( ! info.vividcode.dom ) { info.vividcode.dom = {}; }

// ===== ���� =====
(function() {
//------------------------------
// �萔�ݒ�
//------------------------------
var VERSION = 0.1;
var XHTML_NAMESPACE = "http://www.w3.org/1999/xhtml";
//------------------------------
// �e��֐���`
//------------------------------

/**
 * �C�x���g���X�i��ǉ�����֐�
 * ��{�I�ɂ� IE �ł� Firefox �ł� Safari �ł� Opera �ł������悤�Ɏg����悤�ɂ��Ă���. 
 * IE �ł̓C�x���g���X�i���󂯎��� (Event �I�u�W�F�N�g) �̃v���p�e�B�� currentTarget ���Ȃ���, 
 * ���̊֐����g���Ǝ����I�ɒǉ����Ă����. 
 * �܂�, preventDefault ���\�b�h�� Event �I�u�W�F�N�g�ɒǉ�����. ���̒��g�� window.event.returnValue �� 
 * false ����邾��. 
 *
 * �g����:
 *     var return = addListener( target, type, func );
 * �p�����[�^��:
 *     @param target �C�x���g���X�i��ǉ�����Ώ�. window �I�u�W�F�N�g�� element �I�u�W�F�N�g.
 *     @param type String �^. �C�x���g���X�i���󂯎��C�x���g�̃^�C�v. "click" �� "load" �Ȃ�. 
 *     @param func �C�x���g���X�i���̂���. ���ʂ͊֐�. 
 *     @return �߂�l�� boolean. addEventListener �� attachEvent ����������Ă���� true ���Ԃ�, 
 *             ����ȊO�̏ꍇ�� false. �C�x���g���X�i��ǉ��������ǂ����ł͂Ȃ����Ƃɒ���.
 */
if( ! info.vividcode.dom.addEventListener )
info.vividcode.dom.addEventListener = (function() {
	if ( window.addEventListener ) {
		// DOM Event �����u���E�U�p
		return function(target, type, func) {
			target.addEventListener(type, func, false);
			return true;
		};
	} else if ( window.attachEvent ) { // IE �p
		/**
		 * IE �p��, �C�x���g�`�d���~������֐�
		 */
		if( ! info.vividcode.dom.preventDefaultIE )
		info.vividcode.dom.preventDefaultIE = function() {
			window.event.returnValue = false;
		};
		return function(target, type, func) {
			// ----- �Ǐ��ϐ��̐錾 -----
			var i = 0;
			var hasBeenAdded = false;
			// ----- ���� -----
			// target �̃v���p�e�B�ɊǗ��p�z���ǉ�
			if( ! target._vividcode_el ) {
				target._vividcode_el = new Array(0);
				// unload ���ɉ��
				var cleanupTarget = function(evt) {
					// �z��̒��g�� null ��
					for( i = 0; i < target._vividcode_el.length; i++ ) {
						target._vividcode_el[i][0] = null;
						target._vividcode_el[i][1] = null;
						target._vividcode_el[i] = null;
					}
					// �z��ւ̎Q�Ƃ��Ȃ���
					target._vividcode_el = null;
					// �������g�� detachEvent
					window.detachEvent("onunload", cleanupTarget);
				};
				window.attachEvent("onunload", cleanupTarget);
			}
			// ��ɓo�^�ς݂��ǂ����`�F�b�N����
			hasBeenAdded = false;
			for( i = 0; i < target._vividcode_el.length; i++ ) {
				if( target._vividcode_el[i][0] === func ) {
					hasBeenAdded = true;
					break;
				}
			}
			// ���o�^�̏ꍇ, �o�^����
			if( ! hasBeenAdded ) {
				i = target._vividcode_el.length;
				target._vividcode_el[i] = new Array(func, function(evt) {
					// evt.currentTarget ��ǉ�
					if( ! evt.currentTarget ) { evt.currentTarget = target; }
					// evt.preventDefault ��ǉ�
					if( ! evt.preventDefault ) { evt.preventDefault = info.vividcode.dom.preventDefaultIE; }
					// EventListener �N��
					//func(evt);
					func.apply(target, arguments)
				}, {});
			}
			// addEventListener �̕�ł�, �����֐����d�ɓo�^���悤�Ƃ���� 2 �ڂ͔j����. 
			// attachEvent �̕�� 2 �ڂ͔j���Ȃ�. ����̓���ɂȂ�悤�ɂ���. 
			if( ! target._vividcode_el[i][2][type] ) {
				target.attachEvent("on"+type, target._vividcode_el[i][1]);
				// unload ���� detachEvent ���Ȃ���΃��������[�N���N�����Ƃǂ����œǂ񂾂̂ŔO�̂���. 
				// �K�v�ȏ�� detachEvent ����ꍇ�����邪���Q�͂Ȃ��Ǝv�� 
				// (�������ɓ��쎞�Ԃ͂���Ȃɕς��Ȃ��ł��傤) �̂ŋC�ɂ��Ȃ����Ƃɂ���.
				var cleanupListener = (function () {
					// target._vividcode_el �� onunload �C�x���g�ŉ�̂���̂�, 
					// ���肷��ƎQ�ƑO�ɉ�̂���Ă���\��������. 
					// �����, ���炩���ߋǏ��ϐ��ɓǂݍ���ł���.
					var func = target._vividcode_el[i][1];
					return function(evt) {
						target.detachEvent("on"+type, func);
						window.detachEvent("onunload", cleanupListener);
						// �Ȃ��� IE �ł͉��̕�@���Ƃ����� detachEvent �ł��Ȃ�
						// cleanupListener === myself ���Ȃ��� true ����Ȃ�����
						//window.detachEvent("onunload", myself);
						//window.alert("cleanup listener");
					};
				})();
				target._vividcode_el[i][2][type] = cleanupListener;
				window.attachEvent("onunload", target._vividcode_el[i][2][type]);
			}
			return true;
		};
	} else {
		// addEventListener �� attachEvent �������ĂȂ��u���E�U�p
		return function(elem, type, func) {
			return false;
		};
	}
})();
if( ! info.vividcode.dom.addEL ) {
	info.vividcode.dom.addEL = info.vividcode.dom.addEventListener;
}

/**
 * �C�x���g���X�i���폜����֐�
 *
 * �g����:
 *     var return = removeListener( target, type, func );
 * �p�����[�^��:
 *     @param target �C�x���g���X�i����菜���Ώ�. window �I�u�W�F�N�g�� element �^�I�u�W�F�N�g.
 *     @param type String �^. �C�x���g���X�i���󂯎��C�x���g�̃^�C�v. "click" �� "load" �Ȃ�. 
 *     @param func �C�x���g���X�i���̂���. ���ʂ͊֐�. 
 *     @return �߂�l�� boolean. removeEventListener �� detachEvent ����������Ă���� true ���Ԃ�, 
 *             ����ȊO�̏ꍇ�� false. �폜�������ǂ����ł͂Ȃ����Ƃɒ���. 
 */
if( ! info.vividcode.dom.removeEventListener )
info.vividcode.dom.removeEventListener = (function() {
	if( window.removeEventListener ) {
		// DOM Event �����u���E�U�p
		return function(target, type, func) {
			target.removeEventListener(type, func, false);
			return true;
		};
	} else if( window.detachEvent ) { // IE �p
		return function(target, type, func) {
			// ----- �Ǐ��ϐ��̐錾 -----
			var i = 0;
			var hasBeenAdded = false;
			// ----- ���� -----
			// func ���o�^����Ă��邩�ǂ����`�F�b�N����
			hasBeenAdded = false;
			for( i = 0; i < target._vividcode_el.length; i++ ) {
				if( target._vividcode_el[i][0] === func ) {
					hasBeenAdded = true;
					break;
				}
			}
			// �o�^����Ă���ꍇ, detachEvent
			if( hasBeenAdded ) {
				if( target._vividcode_el[i][2][type] ) {
					target._vividcode_el[i][2][type]();
					delete target._vividcode_el[i][2][type];
				}
				//target.detachEvent("on"+type, target._vividcode_el[i][1]);
			}
			return true;
		};
	} else {
		// addEventListener �� attachEvent �������ĂȂ��u���E�U�p
		return function(elem, type, func) {
			return false;
		}
	}
})();
if( ! info.vividcode.dom.rmvEL )
info.vividcode.dom.rmvEL = info.vividcode.dom.removeEventListener;

if( ! info.vividcode.dom.createXhtmlElement )
info.vividcode.dom.createXhtmlElement = function( aTagName, aAttrs, aChildText ) {
	if( document.createElementNS ) {
		var elem = document.createElementNS(XHTML_NAMESPACE, aTagName);
	} else if( document.createElement ) {
		var elem = document.createElement(aTagName);
	} else {
		throw new Error("document.createElementNS ���\�b�h, ����� document.createElement ���\�b�h����������Ă��܂���...");
	}
	if( aAttrs ) {
		for( var key in aAttrs ) {
			//window.alert(item + ": " + aAttrs[item]);
			elem.setAttribute(key, aAttrs[key]);
		}
	}
	if( aChildText ) {
		elem.appendChild( document.createTextNode(aChildText) );
	}
	return elem;
};
if( ! info.vividcode.dom.crtXhtmlElem )
info.vividcode.dom.crtXhtmlElem = info.vividcode.dom.createXhtmlElement;

if( ! info.vividcode.dom.createHtmlElement )
info.vividcode.dom.createHtmlElement = function( aTagName, aAttrs, aChildText ) {
	if( document.createElement ) {
		var elem = document.createElement(aTagName);
	} else {
		throw new Error("document.createElement ���\�b�h����������Ă��܂���...");
	}
	if( aAttrs ) {
		for( var key in aAttrs ) {
			//window.alert(item + ": " + aAttrs[item]);
			elem.setAttribute(key, aAttrs[key]);
		}
	}
	if( aChildText ) {
		elem.appendChild( document.createTextNode(aChildText) );
	}
	return elem;
};
if( ! info.vividcode.dom.crtHtmlElem )
info.vividcode.dom.crtHtmlElem = info.vividcode.dom.createHtmlElement;

})();
