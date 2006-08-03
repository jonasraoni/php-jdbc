<?php
BigNumber = function(n, p, r){
	var o = this, i;
	if(n instanceof BigNumber){
		for(i in {precision: 0, roundType: 0, _sign: 0, _dec: 0}) o[i] = n[i];
		o._buffer = n._buffer.slice();
		return;
	}
	o.precision = isNaN(p = Math.abs(p)) ? BigNumber.defaultPrecision : p;
	o.roundType = isNaN(r = Math.abs(r)) ? BigNumber.defaultRoundType : r;
	o._sign = (n += "").charAt(0) == "-";
	o._dec = ((n = n.replace(/[^\d.]/g, "").split(".", 2))[0] = n[0].replace(/^0+/, "") || "0").length;
	for(i = (n = o._buffer = (n.join("") || "0").split("")).length; i; n[--i] = +n[i]);
	o._adjust();
};
with({$: BigNumber, o: BigNumber.prototype}){
	$.ROUND_HALF_EVEN = ($.ROUND_HALF_DOWN = ($.ROUND_HALF_UP = ($.ROUND_FLOOR = ($.ROUND_CEIL = ($.ROUND_DOWN = ($.ROUND_UP = 0) + 1) + 1) + 1) + 1) + 1) + 1;
	$.defaultPrecision = 40;
	$.defaultRoundType = $.ROUND_HALF_UP;
	o.add = function(n){
		if(this._sign != (n = new BigNumber(n))._sign) return n._sign = !n._sign, this.subtract(n);
		var o = new BigNumber(this), a = o._buffer, b = n._buffer, la = o._dec, lb = n._dec, n = Math.max(la, lb), i, r;
		la != lb && ((lb = la - lb) > 0 ? o._zeroes(b, lb, 1) : o._zeroes(a, -lb, 1));
		i = (la = a.length) == (lb = b.length) ? a.length : ((lb = la - lb) > 0 ? o._zeroes(b, lb) : o._zeroes(a, -lb)).length;
		for(r = 0; i; r = (a[--i] = a[i] + b[i] + r) / 10 >> 0, a[i] %= 10);
		return r && ++n && a.unshift(r), o._dec = n, o._adjust();
	};
	o.subtract = function(n){
		if(this._sign != (n = new BigNumber(n))._sign) return n._sign = !n._sign, this.add(n);
		var o = new BigNumber(this), x = o.compare(n) + 1, a = x ? o : n, b = x ? n : o, la = a._dec, lb = b._dec, n = la, i, j;
		a = a._buffer, b = b._buffer, la != lb && ((lb = la - lb) > 0 ? o._zeroes(b, lb, 1) : o._zeroes(a, -lb, 1));
		for(i = (la = a.length) == (lb = b.length) ? a.length : ((lb = la - lb) > 0 ? o._zeroes(b, lb) : o._zeroes(a, -lb)).length; i;){
			if(a[--i] < b[i]){
				for(j = i; j && !a[--j]; a[j] = 9);
				--a[j], a[i] += 10;
			}
			b[i] = a[i] - b[i];
		}
		return o._sign = !x, o._dec = n, o._buffer = b, o._adjust();
	};
	o.multiply = function(n){
		var o = new BigNumber(this), r = o.compare(n = new BigNumber(n)) + 1, a = (r ? o : n)._buffer, b = (r ? n : o)._buffer,
		la = a.length, lb = b.length, x = new BigNumber, i, j, s;
		for(i = lb; i; x.set(x.add(new BigNumber(s.join("")))))
			for(s = (new Array(lb - --i)).join("0").split(""), r = 0, j = la; j;
			r += a[--j] * b[i], s.unshift(r % 10), r = r / 10 >>> 0);
		return r && x._buffer.unshift(r), o._dec = (o._buffer = x._buffer).length - la - lb + o._dec + n._dec, o._adjust();
	};
	o.divide = function(n){
		if((n = new BigNumber(n)) == "0") throw new Error("division by 0");
		var o = new BigNumber(this), a = o._buffer, b = n._buffer, la = a.length - o._dec,
		lb = b.length - n._dec, s = a._sign != b._sign, dec = 0, buffer = [], x = new BigNumber, y, i;
		la != lb && ((lb = la - lb) > 0 ? o._zeroes(b, lb) : o._zeroes(a, -lb));
		o._dec = a.length, n._dec = b.length, a = o, b = n, a._sign = false, b._sign = false;
		while(a != 0 && (buffer.length - dec) < o.precision){
			x.set(0);
			for(i = 0; a.compare(y = x.add(b)) + 1 && ++i; x.set(y));
			if(!i){
				do ++i, a._buffer.push(0), ++a._dec;
				while(a.compare(b) < 0);
				!dec && (!buffer.length && buffer.push(0), dec = buffer.length);
				o._zeroes(buffer, --i);
				continue;
			}
			a.set(a.subtract(x)), buffer.push(i);
		}
		return o._buffer = buffer, o._dec = dec ? dec : buffer.length, o._adjust();
	};
	o.mod = function(n){
		var x = new BigNumber(this);
		return x.set(x.subtract(this.divide(n).intPart().multiply(n)));
	};
	o.pow = function(n){
		var o = new BigNumber(this);
		if(typeof n != "number") throw new Error("Error");
		if(n == 0) return o.set(1);
		for(var x = new BigNumber(o), i = Math.abs(n); --i; o.set(o.multiply(x)));
		return n < 0 ? o.set((new BigNumber(1)).divide(o)) : o;
	};
	o.set = function(n){
		return this.constructor(n), this;
	};
	o.compare = function(n){
		var a = this, la = this._dec, b = n, lb = n._dec, i, l;
		if(la != lb) return la > lb ? 1 : -1;
		for(la = (a = a._buffer).length, lb = (b = b._buffer).length, i = -1, l = Math.min(la, lb); ++i < l;)
			if(a[i] != b[i]) return a[i] > b[i] ? 1 : -1;
		return la != lb ? la > lb ? 1 : -1 : 0;
	}
	o.negate = function(){
		var n = new BigNumber(this); return n._sign ^= 1, n;
	};
	o.abs = function(){
		var n = new BigNumber(this); return n._sign = 0, n;
	};
	o.intPart = function(){
		return new BigNumber((this._sign ? "-" : "") + (this._buffer.slice(0, this._dec).join("") || "0"));
	};
	o.valueOf = o.toString = function(){
		var o = this;
		return (o._sign ? "-" : "") + (o._buffer.slice(0, o._dec).join("") || "0") + (o._dec != o._buffer.length ? "." + o._buffer.slice(o._dec).join("") : "");
	};
	o._zeroes = function(n, l, t){
		var s = ["push", "unshift"][t || 0];
		for(++l; --l;  n[s](0));
		return n;
	};
	o._adjust = function(){
		if("_rounding" in this) return this;
		var $ = BigNumber, r = this.roundType, b = this._buffer, d, p, n, x;
		for(this._rounding = true; this._dec > 1 && !b[0]; --this._dec, b.shift());
		for(d = this._dec, p = this.precision + d, n = b[p]; b.length > d && !b[b.length -1]; b.pop());
		x = (this._sign ? "-" : "") + (p - d ? "0." + this._zeroes([], p - d - 1).join("") : "") + 1;
		if(b.length > p){
			n && (r == $.DOWN ? false : r == $.UP ? true : r == $.CEIL ? !this._sign
			: r == $.FLOOR ? this._sign : r == $.HALF_UP ? n >= 5 : r == $.HALF_DOWN ? n > 5
			: r == $.HALF_EVEN ? n >= 5 && b[p - 1] & 1 : false) && this.add(x);
			b.splice(p, b.length - p);
		}
		return delete this._rounding, this;
	};
}
?>