export default {
	formatGP : amount => `${amount.toFixed(2)} gp`,
	formatList : list => (list && list.length) ? list.join(', ') : 'None',
	formatFloat: f => f ? f.toFixed(2) : '',
};