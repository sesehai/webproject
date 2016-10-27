package com.sesehai.magic.fragment;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentActivity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.sesehai.magic.R;


/**
 * @author yangyu
 *  功能描述：搜索fragment页面
 */
public class ListFragment extends Fragment {

    private View mParent;
    private FragmentActivity mActivity;


    /**
     * Create a new instance of DetailsFragment, initialized to show the text at
     * 'index'.
     */
    public static ListFragment newInstance(int index) {
        ListFragment f = new ListFragment();

        // Supply index input as an argument.
        Bundle args = new Bundle();
        args.putInt("index", index);
        f.setArguments(args);

        return f;
    }

    public int getShownIndex() {
        return getArguments().getInt("index", 0);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
            View view = inflater.inflate(R.layout.fragment_list, container,
                false);
        return view;
    }

    @Override
    public void onActivityCreated(Bundle savedInstanceState) {
        super.onActivityCreated(savedInstanceState);
        mParent = getView();
        mActivity = getActivity();
    }


    @Override
    public void onResume() {
        super.onResume();
    }

    @Override
    public void onHiddenChanged(boolean hidden) {
        super.onHiddenChanged(hidden);
        if (!hidden) {
        }
    }

}