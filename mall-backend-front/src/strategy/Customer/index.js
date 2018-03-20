/**
 * 0 隐藏
 * 1 显示
 * -1 禁用
 */
const b = {
    'search_depart':0,
    'column_depart':0,
    'search_group':0,
    'column_group':0,
    'search_user':0,
    'column_user':0
};
const s = {};

const administrator = Object.assign({}, b);
administrator.search_depart = 1;
administrator.column_depart = 1;
administrator.search_group = 1;
administrator.column_group = 1;
administrator.search_user = 1;
administrator.column_user = 1;
administrator.button_transfer = 0;
administrator.button_quit1 = 0;
administrator.button_quit2 = 1;
s['administrator'] = administrator;

const super_manager = Object.assign({}, administrator);
s['super-manager'] = super_manager;

const department_manager = Object.assign({}, b);
department_manager.search_depart = 0;
department_manager.column_depart = 0;
department_manager.search_group = 1;
department_manager.column_group = 1;
department_manager.search_user = 1;
department_manager.column_user = 1;
department_manager.button_transfer = 1;
department_manager.button_quit1 = 1;
department_manager.button_quit2 = 0;
s['sale-manager'] = department_manager;


const group_captain = Object.assign({}, b);
group_captain.search_depart = 0;
group_captain.column_depart = 0;
group_captain.search_group = 0;
group_captain.column_group = 0;
group_captain.search_user = 1;
group_captain.column_user = 1;
group_captain.button_quit1 = 0;
group_captain.button_quit2 = 0;
s['sale-captain'] = group_captain;


const group_member = Object.assign({}, b);
group_member.search_depart = 0;
group_member.column_depart = 0;
group_member.search_group = 0;
group_member.column_group = 0;
group_member.search_user = 0;
group_member.column_user = 0;
group_member.button_quit1 = 0;
group_member.button_quit2 = 0;
s['sale-staff'] = group_member;

export default s;