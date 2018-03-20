/**
 * 0 隐藏
 * 1 显示
 * -1 禁用
 */
const b = {
    'search_depart':0,
    'column_depart':0,
    'add_depart':0,
    'add_member':0
};
const s = {};

const administrator = Object.assign({}, b);
administrator.search_depart = 1;
administrator.column_depart = 1;
administrator.add_depart = 1;
administrator.add_member = 0;
s['administrator'] = administrator;

const super_manager = Object.assign({}, administrator);
s['super-manager'] = super_manager;

const department_manager = Object.assign({}, b);
department_manager.search_depart = 0
department_manager.column_depart = 0
department_manager.add_depart = -1
department_manager.add_member = 1
s['department-manager'] = department_manager;

export default s;