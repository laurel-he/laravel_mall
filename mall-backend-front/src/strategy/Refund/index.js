/**
 * 0 隐藏
 * 1 显示
 * -1 禁用
 */
const b = {
    'operator':0,
};
const s = {};

const administrator = Object.assign({}, b);
administrator.operator = 1;
s['administrator'] = administrator;

const super_manager = Object.assign({}, administrator);
s['super-manager'] = super_manager;

const department_manager = Object.assign({}, administrator);
s['sale-manager'] = department_manager;


const group_captain = Object.assign({}, b);
s['sale-captain'] = group_captain;


const group_member = Object.assign({}, b);
s['sale-staff'] = group_member;

export default s;