package com.sesehai.magic.activity;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.view.Window;

import com.sesehai.magic.R;
import com.sesehai.magic.fragment.FragmentIndicator;

public class HomeActivity extends AppCompatActivity {

    public static Fragment[] mFragments;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        setContentView(R.layout.activity_home);
        setFragmentIndicator(0);

    }

    /**
     * 初始化fragment
     */
    private void setFragmentIndicator(int whichIsDefault) {
        mFragments = new Fragment[3];
        mFragments[0] = getSupportFragmentManager().findFragmentById(R.id.fragment_home);
        mFragments[1] = getSupportFragmentManager().findFragmentById(R.id.fragment_list);
        mFragments[2] = getSupportFragmentManager().findFragmentById(R.id.fragment_settings);
        getSupportFragmentManager().beginTransaction().hide(mFragments[0])
                .hide(mFragments[1]).hide(mFragments[2]).show(mFragments[whichIsDefault]).commit();

        FragmentIndicator mIndicator = (FragmentIndicator) findViewById(R.id.indicator);
        FragmentIndicator.setIndicator(whichIsDefault);
        mIndicator.setOnIndicateListener(new FragmentIndicator.OnIndicateListener() {
            @Override
            public void onIndicate(View v, int which) {
                getSupportFragmentManager().beginTransaction()
                        .hide(mFragments[0]).hide(mFragments[1])
                        .hide(mFragments[2]).show(mFragments[which]).commit();
            }
        });
    }

    @Override
    protected void onResume() {
        super.onResume();
    }

    @Override
    protected void onPause() {
        super.onPause();
    }

}
